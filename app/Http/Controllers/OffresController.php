<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Visite;
use App\Models\Candidature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class OffresController extends Controller

{

    public $types_offre = ['Freelance' => 'Freelance', 'CDI' => 'CDI', 'CDD' => 'CDD', 'Stage' => 'Stage'];

    public function __construct()
    {
        $this->ctx = 'offres_';
        //parent::__construct();
    }



    public function index()
    {
        $user = Auth::user();

        if (!empty($user) && $user->hasRole('admin')) {
            $offres = Offre::orderBy('updated_at', 'desc')->paginate(10);
            $meta   = ['title' => 'Gestion des offres de missions IT HOMSYS', 'description' => 'Gestion des offres et missions IT HOMSYS', 'created_at' => Carbon::now()];
            return view('offres.index', compact('offres', 'meta'));
        }

        $nb_offres = Offre::where('exp_offre', 0)->count();
        $offres_news = Offre::where('exp_offre', 0)->orderBy('updated_at', 'desc')->take(5)->get();
        $meta = ['title' => 'Offres emploi IT freelance & CDI au Maroc | HOMSYS', 'description' => 'Trouvez les meilleures offres d\'emploi IT freelance, CDI, CDD et stage au Maroc sur HOMSYS', 'created_at' => Carbon::now()];

        return view('offres.index_candidat', compact('nb_offres', 'offres_news', 'meta'));
    }


    public function show($id)
    {
        $id    = head(explode('-', $id));
        $offre = Offre::where('id_offre', $id)->first();
        if ($offre == null) {
            return redirect()->back();
        }
        $description = !empty($offre->poste) ? strip_tags($offre->poste) : $offre->titre_offre;
        $description = \Illuminate\Support\Str::limit($description, 160);
        
        $meta = [
            'title' => $offre->titre_offre, 
            'description' => $description, 
            'created_at' => $offre->updated_at,
            'type' => 'article', // Better for specific content pages
        ];
        $user = Auth::user();
        if (empty($user)) {
            $visite           = new Visite;
            $visite->id_offre = $id;
            $visite->save();
            return view('offres.show', compact('offre', 'meta'));
        }
 
        if ($user->hasRole('candidat')) {
            $visite           = new Visite;
            $visite->id_user  = $user->id;
            $visite->id_offre = $id;
            $visite->save();
        }
 
        if ($user->hasRole('admin')) {
            $candidatures     = Candidature::where('offre_id', $id)->count();
            $visite_offres_nb = Visite::where('id_offre', $id)->count();
            $visite_offre_jour = DB::select('
                    SELECT
                        DATE(v.created_at)   AS jour,
                        COUNT(v.id)   AS visites,
                        COUNT(c.id)          AS candidatures
                    FROM visites v
                    JOIN offres o
                        ON v.id_offre = o.id_offre
                    LEFT JOIN candidatures c
                        ON  c.offre_id = ?
                        AND DATE(c.created_at) = DATE(v.created_at)
                    WHERE v.id_offre = ?
                    GROUP BY DATE(v.created_at)
                    ORDER BY DATE(v.created_at) DESC
                ', [$id, $id]);
            $candidatures_offre = $visite_offre_jour;
            $types_offre = $this->types_offre;
            return view('offres.show_admin', compact('offre', 'visite_offres_nb', 'candidatures', 'candidatures_offre', 'visite_offre_jour', 'types_offre', 'meta'));
        }
        return view('offres.show', compact('offre', 'meta'));
    }


    public function create()
    {        
        $user = Auth::user();
        if (empty($user) || !$user->hasRole('admin')) {
            return redirect('logins')->withSuccess(['Merci de se connecter']);
        }
        $types_offre = $this->types_offre;          
        $meta        = ['title' => 'Nouvelle offre HOMSYS', 'description' => 'Nouvelle offre HOMSYS', 'created_at' => Carbon::now()];
        return view('offres.create', compact('meta', 'types_offre'));
    }


    public function store(\Illuminate\Http\Request $request)
    {
        $validator = Validator::make(Request::all(), [
            'titre_offre' => 'required|min:5',
            'ville_offre' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput(Request::except('_token'))->withErrors($validator);
        }
        Offre::create(Request::all());
        return redirect('offres')->withSuccess(['Offre créee']);
    }

   public function delete($id)
    {
        $user = Auth::user();
        if (empty($user) || !$user->hasRole('admin')) {
            return redirect('logins');
        }
        $offre = Offre::find($id);
        $offre->delete();
        return redirect('offres')->withSuccess(['Offre supprimée']);
    }



    public function update($id)
    {

        $user = Auth::user();

        if (empty($user) || !$user->hasRole('admin')) {

            return redirect('logins');

        }

        $offre = Offre::where('id_offre', $id)->first();

        $offre->update(Request::all());

        if (Request::get('exp_offre') !== "1") {         
            $offre->exp_offre = 0;
            $offre->save();
        }

        $meta = ['title' => 'Modification ' . $offre->titre_offre, 'description' => 'Modification ' . $offre->titre_offre, 'created_at' => Carbon::now()];

        return redirect('offres')->withSuccess(['Offre modifiée']);



    }



    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $ville = $request->input('ville', '');
        $type = $request->input('type', '');

        $meta = [
            'title' => 'Recherche d\'offres IT | HOMSYS',
            'description' => 'Recherche d\'offres d\'emploi IT freelance, CDI, CDD et stage au Maroc sur HOMSYS',
            'created_at' => Carbon::now(),
        ];

        return view('offres.index_candidat', compact('keyword', 'ville', 'type', 'meta'));
    }



    public function postuler($id)

    {

        $offre = Offre::where('id_offre', $id)->first();

        $title = '';

        if ($offre instanceof \Illuminate\Database\Eloquent\Model) {

            $title = $offre->titre_offre;

        }

        $meta = ['title' => 'Postuler à l\'offre' . $title, 'description' => 'Postuler à l\'offre ' . $title, 'created_at' => Carbon::now()];

        return view('offres.postule', compact('meta', 'offre'));

    }

    public function linkedinPost($id)
    {
        $offre = Offre::findOrFail($id);

        $title    = $offre->titre_offre ?? '';
        $type     = $offre->type_offre ?? '';
        $location = $offre->ville_offre ?? '';
        $duration = $offre->duree ?? '';
        $exp_yrs  = $offre->experience ?? '';
        $profil   = trim(strip_tags($offre->profil ?? ''));
        $skills   = trim(strip_tags($offre->competences ?? ''));
        $poste    = trim(strip_tags($offre->poste ?? ''));
        $details  = trim(strip_tags($offre->description_offre ?? ''));
        $url      = url('offres/' . $offre->id_offre);

        $intro   = "🚀 **NOUVELLE OPPORTUNITÉ** 🚀\n\n";
        $intro  .= "Nous recrutons un(e) **{$title}**";

        if ($location) {
            $intro .= " pour notre client à **{$location}**";
        }

        $intro .= " !\n\n";

        $body = "";
        if ($type)     $body  .= "📌 **Type** : {$type}\n";
        if ($duration) $body  .= "⏳ **Durée** : {$duration}\n";
        if ($exp_yrs)  $body  .= "🎯 **Expérience** : {$exp_yrs} an(s)\n";

        if ($location) $body .= "📍 **Lieu** : {$location}\n";

        $body .= "\n";

        if ($poste) {
            $body .= "**📋 Le poste :**\n{$poste}\n\n";
        }

        if ($profil) {
            $body .= "**👤 Profil recherché :**\n{$profil}\n\n";
        }

        if ($skills) {
            $body .= "**🔧 Compétences :**\n{$skills}\n\n";
        }

        if ($details && strlen($body) < 600) {
            $body .= "**📝 Description :**\n{$details}\n\n";
        }

        $cta      = "👉 **Postulez dès maintenant** : {$url}\n\n";
        $cta     .= "💼 #HOMSYS #Recrutement #{$title} #Emploi #Maroc";

        if ($type) $cta .= " #{$type}";
        if ($location) $cta .= " #{$location}";

        $postContent = $intro . $body . $cta;

        if (strlen($postContent) > 3000) {
            $postContent = mb_substr($postContent, 0, 2997) . '...';
        }

        $linkedinShareUrl = 'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode($url);

        return response()->json([
            'post'     => $postContent,
            'shareUrl' => $linkedinShareUrl,
            'offerUrl' => $url,
        ]);
    }

}
