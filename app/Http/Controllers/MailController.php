<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Cv;
use App\Models\Offre;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Request;

class MailController extends Controller
{
    public function index()
    {
        return view('mails.index');
    }
    public function show()
    {
        return view('mails.mail');

    }
    public function send()
    {

        Mail::send('email.test', ['titre' => 'HOMSYS'], function ($message) {
            $message->to(Request::get('email'))->subject(Request::get('objet'));

        });
    }

    public function offre()
    {
        $user = Auth::user();
        $id   = Request::get('offre');

        if (empty($user)) {
            Request::session()->flash('mail', 'Merci de se connecter');
            Request::session()->put('offre_mail', $id);
            return redirect('login');

        }
        if (!($user->hasRole('candidat'))) {
            return redirect('login');
        }
        $offre = Offre::where('id_offre', $id)->first();
        $titre = "Offre : " . $offre->titre_offre;

        //$link = Request::get('link');
        $email = Request::get('email');
        $link  = "https://homsys.ma/offres/" . $id;
        Mail::send('email.test', compact('link', 'email', 'offre'), function ($message) use ($email) {
            $message->to($email)->subject('Cette offre vous intéresse ?');

        });
        return redirect()->back();
    }

    public function postuler()
    {
        /*foreach (Request::all() as $key => $value) {
        \Log::info($key . ' =>' . $value);
        }*/
        $rules = [
            'cv'            => 'required|mimes:doc,docx,pdf|max:2048',
            'email'         => 'required|email',
            'nom'           => 'required|max:100',
            'tjm'           => 'required|numeric',
            'disponibilite' => 'required|max:100',
        ];

        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput(Request::except('_token'))->withErrors($validator);
        }

        $file = Request::file('cv');
        $extension = $file->getClientOriginalExtension();
        $fileName = 'cv_' . date("Y_m_d") . '_' . Str::random(10) . '.' . $extension;
        
        $storedPath = Storage::disk('local')->putFileAs('cv', $file, $fileName);

        // CV
        $cv             = new Cv;
        $cv->is_live_cv = 0;
        $cv->lien_cv    = $storedPath;
        $cv->save();
        //Candidature
        $offre                      = Offre::find(Request::get('id_offre'));
        $candidature                = new Candidature();
        $candidature->nom           = Request::get('nom');
        $candidature->email         = Request::get('email');
        $candidature->telephone     = Request::get('telephone');
        $candidature->disponibilite = Request::get('disponibilite');
        $candidature->tjm           = Request::get('tjm');
        $candidature->message       = Request::get('message');
        $candidature->offre_id      = $offre->id_offre;
        $candidature->cv_id         = $cv->id_cv;
        $candidature->save();
        //Email
        $email         = Request::get('email');
        $nom           = Request::get('nom');
        $telephone     = Request::get('telephone');
        $texto         = Request::get('message');
        $disponibilite = Request::get('disponibilite');
        $tjm           = Request::get('tjm');
        $titre         = $offre->titre_offre;

        Mail::send('email.candidature', compact('nom', 'email', 'telephone', 'texto', 'disponibilite', 'tjm', 'titre'), function ($message) use ($email, $storedPath, $titre) {
            $message->from($email)->to('jobs@homsys.ma')->subject('Candidature Offre ' . $titre)->attach(Storage::disk('local')->path($storedPath));

        });
        return redirect('/offres/' . $offre->id_offre)->withSuccess(['Candidature envoyée, Merci pour votre interêt']);

    }

    public function news()
    {
        /*
        $offres_news=Offre::where('exp_offre',0)->orderBy('created_at', 'desc')->take(5)->get();
        Mail::send('email.news',compact('$offres_news'),function($message){
        $message->to('mojahid.idelaameur@gmail.com')->subject('Nos dernières offres');

        });*/
        return "test";
    }

    public function contact()
    {
        /*foreach (Request::all() as $key => $value) { 
        \Log::info($key . ' =>' . $value);
        }*/
        $date  = date('Y-m-d H:i:s');
        $text  = Request::get('message');
        $email = Request::get('email');
        $name  = Request::get('name');
        $sujet = Request::get('sujet');
        $tel   = Request::get('tel');

        Mail::send('email.contact', compact('text', 'email', 'name', 'date', 'sujet', 'tel'), function ($message) use ($email, $sujet) {
            $message->from($email)->to('contact@homsys.ma')->subject('Contact' . ($sujet ? ' - ' . $sujet : ''));
        });

        return redirect()->back()->withSuccess(['Email envoyé. Nous vous contacterons dans les meilleurs délais, merci pour votre interêt']);
    }

    
    public function contactus()

    {

        $meta = ['title' => 'HOMSYS : Contactez-nous', 'description' => 'HOMSYS : Contactez-nous', 'created_at' => Carbon::now()];

        return view('contact', compact('meta'));

    }


    
}
