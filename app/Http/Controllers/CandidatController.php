<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Cv;
use App\Models\Role;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Request;
use Session;
use Carbon\Carbon;

class CandidatController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect('logins');
        }
        if ($user->hasRole('admin')) {
            return redirect('logins');
        }
        $candidat = Candidat::where('id_candidat', $user->candidat_id)->first();

        Session::put('candidat', $candidat);
        $meta = ['title' => 'Liste des candidats HOMSYS', 'description' => 'Liste des candidats HOMSYS', 'created_at' => Carbon::now()];
        return view('candidats.index', compact('candidat', 'meta'));
    }

    public function all()
    {
        $user = Auth::user();
        if (empty($user) || !$user->hasRole('admin')) {
            return redirect('logins');
        }
        $candidats = Candidat::where('suprimm_candidat', 0)->get();
        $meta      = ['title' => 'Gestion des candidats', 'description' => 'Espace de gestion des candidats HOMSYS', 'created_at' => Carbon::now()];

        return view('candidats.index_admin', compact('candidats', 'meta'));
    }

    public function create()
    {
        $meta = ['title' => 'Nouveau candidat', 'description' => 'Nouveau candidat HOMSYS', 'created_at' => Carbon::now()];
        return view('candidats.create', compact('meta'));
    }

    public function user()
    {
        $rules = array(
            'username'         => 'required|unique:users', // just a normal required validation
            'email'            => 'required|email|unique:users', // required and must be unique in the ducks table
            'password'         => 'required',
            'password_confirm' => 'required|same:password',
        ); // required and has to match the password field

        $validator = Validator::make(Request::all(), $rules);

        if ($validator->fails()) {
            $titre    = "Une erreur s'est produite lors de l'inscription";
            $messages = $validator->messages();

            return redirect()->back()->withInput(Request::except('_token', 'password', 'password_confirm'))->withErrors($validator);

        }
        $user           = new User();
        $user->username = Request::get('username');
        $user->email    = Request::get('email');
        $user->password = Hash::make(Request::get('password'));

        $user->save();

        $role    = Role::where('name', 'candidat')->first();
        $id_role = $role->id;
        $user->roles()->attach($id_role);
        $id_user = $user->id;
        Session::flash('success', 'Votre compte est bien crée, Mercide compléter votre profil');
        $mode = 'create';
        $meta = ['title' => 'Inscription HOMSYS', 'description' => 'Inscription HOMSYS', 'created_at' => Carbon::now()];
        return view('candidats.candidat_create', compact('id_user', 'meta', 'mode'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $meta  = ['title' => 'Inscription', 'description' => 'Inscription HOMSYS', 'created_at' => Carbon::now()];
        $mode  = Request::get('mode');
        $rules = [
            'cv'              => 'required|mimes:doc,docx,pdf|max:1024',
            'nom_condidat'    => 'required|max:100',
            'prenom_condidat' => 'required|max:100',
            'telephone'       => 'required|numeric|min:10',
            'commentaire'     => 'max:2000',
        ];
        $id_user = Request::get('id_candidat');
        if ($mode == 'spontane') {
            $rules = array_merge($rules, ['email' => 'required|email']);
        }

        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return view('candidats.candidat_create', compact('id_user', 'meta', 'mode'))->withErrors($validator)->withRequest(Request::except('password', 'password_confirm'));
        }

        $file            = Request::file('cv');
        $extension       = $file->getClientOriginalExtension();
        $filename        = Str::slug(Request::get('nom_condidat') . "_" . Request::get('prenom_condidat'));
        if (!empty($id_user)) {
            $filename = $filename . "_" . $id_user;
        }
        $filename = 'cv_' . $filename . "_" . Str::random(10) . "." . $extension;
        
        $storedPath = Storage::disk('local')->putFileAs('cv', $file, $filename);
        
        //CV
        $cv             = new Cv();
        $cv->is_live_cv = 0;
        $cv->lien_cv    = $storedPath;
        $cv->save();

        $fields = ['cv_candidat' => $cv->id_cv];
        if (!empty($id_user)) {
            $user            = User::find($id_user);
            $fields['email'] = $user->email;
        }

        Candidat::create(array_merge(Request::except('id_candidat'), $fields));

        // Send email notification to jobs@homsys.ma
        $email        = Request::get('email', !empty($user) ? $user->email : '');
        $nom          = Request::get('nom_condidat');
        $prenom       = Request::get('prenom_condidat');
        $telephone    = Request::get('telephone');
        $texto        = Request::get('commentaire');
        $niveau       = Request::get('niveau');
        $experience   = Request::get('experience');
        $fonction     = Request::get('fonction_candidat');
        $entreprise   = Request::get('entreprise_candidat');
        $titre        = 'Candidature Spontanée - ' . $nom . ' ' . $prenom;

        try {
            Mail::send('email.candidature', [
                'nom'           => $nom . ' ' . $prenom,
                'email'         => $email,
                'telephone'     => $telephone,
                'texto'         => "Fonction: {$fonction} | Entreprise: {$entreprise} | Niveau: {$niveau} | Exp: {$experience}\n\nCommentaire:\n{$texto}",
                'disponibilite' => 'Spontanée',
                'tjm'           => 'N/A',
                'titre'         => $titre,
            ], function ($message) use ($email, $storedPath, $titre) {
                $message->from($email ? $email : 'noreply@homsys.ma')
                        ->to('jobs@homsys.ma')
                        ->subject($titre)
                        ->attach(Storage::disk('local')->path($storedPath));
            });
        } catch (\Exception $e) {
            \Log::error('Error sending spontaneous candidature email: ' . $e->getMessage());
        }

        return redirect('/offres')->withSuccess(['Candidature enregistrée, Merci pour votre interêt']);
    }

    public function current()
    {
        $user     = Auth::user();
        $candidat = Candidat::where('id_candidat', $user->id)->first();
        return $candidat;
    }

    public function show($id)
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect('logins');
        }
        $candidat = Candidat::find($id);
        if ($user->hasRole('admin')) {
            $meta = ['title' => 'Compte candidat ' . $candidat->nom_condidat, 'description' => 'Modification Compte candidat ' . $candidat->nom_condidat, 'created_at' => $candidat->updated_at];
            return view('candidats.show_admin', compact('candidat', 'user', 'meta'));
        }
        $id_user = $id;
        $mode    = 'modify';
        $meta    = ['title' => 'Mon compte', 'description' => 'Mon compte', 'created_at' => Carbon::now()];
        return view('candidats.show', compact('candidat', 'user', 'id_user', 'mode', 'meta'));
    }

    public function modify($id)
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect('logins');
        }
        if ($user->hasRole('admin')) {
            return view('candidats.show_admin', compact('candidat', 'user'));
        }
        $candidat = Candidat::find($id);
        $mode     = 'modify';
        $meta     = ['title' => 'Mon compte ' . $candidat->nom_condidat, 'description' => 'Mon compte ' . $candidat->nom_condidat, 'created_at' => $candidat->updated_at];
        return view('candidats.update', compact('candidat', 'mode', 'meta'));
    }

    public function update()
    {        
        $candidat = Candidat::find(Request::get('id_candidat'));
        //$user                          = User::where('id', $id)->first();
        // 2. Mettre à jour tous les champs envoyés par la requête
        $candidat->update(Request::all());        

        Session::flash('success', 'Modification effectuée');
        $mode = 'modify';
         $meta = [
        'title' => 'Mon compte ' . $candidat->nom_condidat, 
        'description' => 'Mon compte ' . $candidat->nom_condidat, 
        'created_at' => $candidat->updated_at
        ];
        return view('candidats.update', compact('candidat', 'mode', 'meta'));
    }

    public function delete($id)
    {
        $user = Auth::user();
        if (empty($user) || !$user->hasRole('admin')) {
            return redirect('logins');
        }
        $candidat                   = Candidat::where('id_candidat', $id)->first();
        $candidat->suprimm_candidat = 1;
        $candidat->save();
        return redirect('candidats');
    }

    public function spontane()
    {
        
        $id_user = null;
        $mode    = 'spontane';
        $meta    = ['title' => 'Candiature spontanée', 'description' => 'Candiature spontanée', 'created_at' => Carbon::now()];
        return view('candidats.candidat_create', compact('id_user', 'meta', 'mode'));
    }

    public function portage()
    {
        $meta = ['title' => 'Portage salariale HOMSYS', 'description' => 'Portage salariale HOMSYS', 'created_at' => Carbon::now()];
        return view('portage', compact('meta'));
    }
}
