<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Candidature;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $lastest_offres = Offre::where('exp_offre', 0)->orderBy('updated_at', 'desc')->take(6)->get();
        $nb_offres         = Offre::count() + 1000;
        $nb_cv             = Candidature::count() + 10000;
        $nb_clients        = 163;
        $meta = [
            'title' => 'Offres emploi IT freelance & CDI au Maroc | HOMSYS',
            'description' => 'Trouvez les meilleures offres d\'emploi IT freelance, CDI, CDD et stage au Maroc. Développeurs, DBA, chefs de projets — postulez sur homsys.ma',
            'created_at' => Carbon::now(),
        ];
        return view('index', compact('lastest_offres', 'nb_offres', 'nb_cv', 'nb_clients', 'meta'));
    }

    public function about()
    {
         $nb_offres         = Offre::count() + 1000;
        $nb_cv             = Candidature::count() + 10000;
        $nb_clients        = 163;
        $meta = ['title' => 'À propos | HOMSYS - Cabinet de recrutement IT au Maroc', 'description' => 'HOMSYS, cabinet de recrutement spécialisé en IT au Maroc depuis 2009. Expertise, transparence et accompagnement personnalisé.', 'created_at' => Carbon::now()];
        return view('about', compact('nb_offres', 'nb_cv', 'nb_clients', 'meta'));
    }

    public function sitemap()
    {
        $offres = Offre::select(["id_offre", "updated_at"])
        // you may want to add where clauses here according to your needs
            ->orderBy("id_offre", "desc")
            ->take(50000) // each Sitemap file must have no more than 50,000 URLs and must be no larger than 10MB
            ->get();

        $content = \View::make('sitemap', ['offres' => $offres]);
        return \Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');
    }

}
