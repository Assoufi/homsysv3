<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function index() {

        return view('admin_login');

    }

    public function create() {

        $user = new User;

        $user->username     = Request::get('username');

        $user->email    = Request::get('email');

        $user->password = Hash::make(Request::get('password'));



        $user->save();



        $role = Role::where('name','admin')->first();

        $user->roles()->attach($role->id);

        $id_user = $user->id;



        $candidat = Candidat::where('email', $user->email)->first();

        if ($candidat == null) {

            $candidat = new Candidat;

            $candidat->email = $user->email;

            $candidat->save();

        }

        $user->save();

    }



    public function login()

    {

        $email = Request::get('email');

        $password = Request::get('password');
        
        $meta = ['title' => 'Mon Espace Administration', 'description' => 'Mon Espace Administration', 'created_at' => Carbon::now()];

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $admin = User::where('email',$email)->first();

            if($admin->hasRole('admin')) {

                Session::put('admin', $admin);

                return redirect('/admin/index')->with( ['meta' => $meta] );

            } 

            if(!empty(Request::session()->get('offre_mail'))) {

                $id=Request::session()->get('offre_mail');

                Request::session()->forget('offre_mail');

                return redirect()->route('offre', ['id' => $id]);

            }

            return redirect('/candidats/index')->with( ['meta' => $meta] );

        } 

        Request::session()->flash('login', 'L’e-mail entré ne correspond à aucun compte ou mot de passe entré est incorrect. ');

        return redirect('/logins')
    ->withErrors(['login' => "L'e-mail entré ne correspond à aucun compte ou le mot de passe est incorrect."])
    ->withInput(Request::only('email'));



    }



    public function dashboard()

    {
        $user = Auth::user();
        if (empty($user) || !$user->hasRole('admin')) {
            return redirect('logins');
        }

        $admin = Session::get('admin');

        $visites_offre = DB::select('select v.id_offre AS id_offre,o.titre_offre AS titre_offre,COUNT(1) AS visite_offre,
        (SELECT COUNT(1)
           FROM candidatures c
           WHERE c.offre_id = v.id_offre   
          ) AS candidatures 
        from visites v 
        join offres o ON v.id_offre = o.id_offre
        group by v.id_offre, o.titre_offre
        order BY o.updated_at DESC
        LIMIT 30');

        $visite_jour = DB::select('select jour, visite, 
        (SELECT COUNT(1) FROM candidatures c WHERE DATE(c.created_at) = jour) AS candidatures 
        from (
            select DATE(v.created_at) as jour, COUNT(1) AS visite
            from visites v 
            group by DATE(v.created_at)
        ) as subquery
        order by jour DESC
        LIMIT 30');

        return view('admin.index',compact('admin','visites_offre','visite_jour'));
    }
}