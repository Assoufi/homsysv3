<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Cv;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Request;
use Session;

class CvController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (empty($user)) {
            return redirect('login');
        }

        if ($user->hasRole('admin')) {
            Auth::logout();
            Session::flush();
            return redirect('/admin');
        }
        $candidat = Candidat::where('id_candidat', $user->id)->first();
        return view('cv.index', compact('candidat'));
    }

    public function upload()
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect('login');
        }

        if ($user->hasRole('admin')) {
            Auth::logout();
            Session::flush();
            return redirect('/admin');
        }
        $candidat = Candidat::where('id_candidat', $user->id)->first();
        $file = Request::file('cv');
        if (empty($file)) {
            Request::session()->flash('extension', 'Merci de sélectionner un fichier.');
            return redirect('/candidats/cv');
        }

        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, ['pdf', 'doc', 'docx'])) {
            Request::session()->flash('extension', "L'extension {$extension} n'est pas supportée.");
            return redirect('/candidats/cv');
        }

        // Store outside webroot (storage/app/cv) with a safe randomized name.
        $filename = 'cv_' . $user->id . '_' . Str::random(40) . '.' . $extension;
        $storedPath = Storage::disk('local')->putFileAs('cv', $file, $filename);
        if (empty($storedPath)) {
            Request::session()->flash('extension', "Une erreur s'est produite lors de l'upload.");
            return redirect('/candidats/cv');
        }

        $cv             = new Cv;
        $cv->is_live_cv = 0;
        $cv->lien_cv    = $storedPath; // e.g. cv/cv_123_xxx.pdf (stored under storage/app)
        $cv->save();
        $candidat->cv_candidat = $cv->id_cv;
        $candidat->save();
        Request::session()->flash('cv', 'Votre cv a été enregistré');
        return redirect('/candidats/cv');
    }

    public function show()
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect('login');
        }

        if ($user->hasRole('admin')) {
            Auth::logout();
            Session::flush();
            return redirect('/admin');
        }
        $candidat = Candidat::where('id_candidat', $user->id)->first();
        $cv       = Cv::where('id_cv', $candidat->cv_candidat)->first();
        return view('cv.show', compact('candidat', 'cv'));
    }

    public function live()
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect('login');
        }

        if ($user->hasRole('admin')) {
            Auth::logout();
            Session::flush();
            return redirect('/admin');
        }
        $candidat = Candidat::where('id_candidat', $user->id)->first();
        $cv       = Cv::where('id_cv', $candidat->cv_candidat)->first();
        return view('cv.live', compact('candidat', 'cv'));
    }

    public function livesubmit()
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect('login');
        }

        if ($user->hasRole('admin')) {
            Auth::logout();
            Session::flush();
            return redirect('/admin');
        }
        $candidat = Candidat::where('id_candidat', $user->id)->first();

        $cv             = new Cv;
        $cv->is_live_cv = 1;
        $cv->live_cv    = Request::input('live_cv');
        $cv->save();
        $candidat->cv_candidat = $cv->id_cv;
        $candidat->save();
        Request::session()->flash('cv', 'Votre cv a été bien enregistré');
        return redirect('/candidats/cv');
    }

    public function download($id)
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect('login');
        }

        $cv = Cv::where('id_cv', $id)->first();
        if (empty($cv) || empty($cv->lien_cv)) {
            abort(404);
        }

        if (!$user->hasRole('admin')) {
            $candidat = Candidat::where('id_candidat', $user->id)->first();
            if (empty($candidat) || (int) $candidat->cv_candidat !== (int) $cv->id_cv) {
                abort(403);
            }
        }

        $downloadName = 'cv_' . $cv->id_cv . '.' . pathinfo($cv->lien_cv, PATHINFO_EXTENSION);

        // Preferred location: storage/app/{lien_cv}
        if (Storage::disk('local')->exists($cv->lien_cv)) {
            return response()->download(Storage::disk('local')->path($cv->lien_cv), $downloadName);
        }

        // Backward compatibility: legacy public uploads (e.g. public/cv/xxx.pdf)
        if (file_exists(public_path($cv->lien_cv))) {
            return response()->download(public_path($cv->lien_cv), $downloadName);
        }

        abort(404);
    }

    public function preview($id)
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect('login');
        }

        $cv = Cv::where('id_cv', $id)->first();
        if (empty($cv) || empty($cv->lien_cv)) {
            abort(404);
        }

        if (!$user->hasRole('admin')) {
            $candidat = Candidat::where('id_candidat', $user->id)->first();
            if (empty($candidat) || (int) $candidat->cv_candidat !== (int) $cv->id_cv) {
                abort(403);
            }
        }

        $filePath = $cv->lien_cv;
        if (Storage::disk('local')->exists($filePath)) {
            $fullPath = Storage::disk('local')->path($filePath);
            $mimeType = mime_content_type($fullPath);
            return response()->file($fullPath, ['Content-Type' => $mimeType, 'Content-Disposition' => 'inline']);
        }

        abort(404);
    }
}