<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{

    public function showForgotForm()
    {
        $meta = ['title' => 'Mot de passe oublié', 'description' => 'Réinitialisation de mot de passe'];
        return view('auth.passwords.email', compact('meta'));
    }


    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Veuillez entrer votre adresse email.',
            'email.email'    => 'Veuillez entrer une adresse email valide.',
            'email.exists'   => 'Aucun compte trouvé avec cette adresse email.',
        ]);

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        $link = url('password/reset', $token) . '?email=' . urlencode($request->email);

        try {
            Mail::send('auth.emails.password', [
                'link'  => $link,
                'email' => $request->email,
            ], function ($message) use ($request) {
                $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->to($request->email)
                        ->subject('Réinitialisation de votre mot de passe - HOMSYS');
            });

            return back()->with('success', 'Un lien de réinitialisation vous a été envoyé par email.');
        } catch (\Exception $e) {
            \Log::error('Password reset email failed: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Impossible d\'envoyer l\'email. Veuillez réessayer plus tard.']);
        }
    }


    public function showResetForm($token)
    {
        $meta = ['title' => 'Nouveau mot de passe', 'description' => 'Réinitialisation de mot de passe'];
        return view('auth.passwords.reset', compact('token', 'meta'));
    }


    public function reset(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'token'    => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.required'     => 'Veuillez entrer votre adresse email.',
            'email.email'        => 'Adresse email invalide.',
            'email.exists'       => 'Aucun compte trouvé avec cette adresse email.',
            'password.required'  => 'Veuillez entrer un nouveau mot de passe.',
            'password.min'       => 'Le mot de passe doit contenir au moins 6 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => 'Le lien de réinitialisation est invalide.']);
        }

        if (Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'Ce lien a expiré. Veuillez refaire une demande.']);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/logins')->with('success', 'Votre mot de passe a été réinitialisé. Vous pouvez maintenant vous connecter.');
    }


    public function showChangeForm()
    {
        $meta = ['title' => 'Modifier mon mot de passe', 'description' => 'Changement de mot de passe'];
        return view('auth.passwords.change', compact('meta'));
    }


    public function change(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Veuillez entrer votre mot de passe actuel.',
            'password.required'         => 'Veuillez entrer un nouveau mot de passe.',
            'password.min'              => 'Le mot de passe doit contenir au moins 6 caractères.',
            'password.confirmed'        => 'Les mots de passe ne correspondent pas.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Votre mot de passe a été modifié avec succès.');
    }
}
