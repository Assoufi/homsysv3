<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OffresController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/portage', [CandidatController::class, 'portage']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [MailController::class, 'contactus']);
Route::get('/portage', [CandidatController::class, 'portage']);
Route::post('/logout', function () {
    Auth::logout();
    Session::flush();
    return redirect('/logins');
})->name('logout');

Route::get('/article1', [ArticleController::class, 'article1']);
Route::get('/article2', [ArticleController::class, 'article2']);
Route::get('/article3', [ArticleController::class, 'article3']);

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::group(['prefix' => 'offres'], function () {
    Route::get('/', [OffresController::class, 'index'])->name('offres.index');
    Route::get('/search', [OffresController::class, 'search']);
    Route::get('/postule/{id}', [OffresController::class, 'postuler']);
    
    // Protected Offre actions
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/create', [OffresController::class, 'create'])->name('offres.create');
        Route::delete('/{id}', [OffresController::class, 'delete']);
        Route::post('/update/{id}', [OffresController::class, 'update']);
        Route::post('/', [OffresController::class, 'store'])->name('offres.store');
        Route::get('/linkedin-post/{id}', [OffresController::class, 'linkedinPost']);
    });

    Route::get('/{id}', [OffresController::class, 'show'])->name('offre');
    
    Route::post('/search', [OffresController::class, 'search'])->name('search');
});

Route::group(['prefix' => 'candidats'], function () {

    Route::get('/spontane', [CandidatController::class, 'spontane']);
    Route::get('/create', [CandidatController::class, 'create']);
    Route::post('/create', [CandidatController::class, 'user']);
    Route::post('/store', [CandidatController::class, 'store']);
    
    Route::middleware(['auth'])->group(function () {
        Route::middleware(['role:candidat'])->group(function () {
            Route::get('/index', [CandidatController::class, 'index']);
            Route::get('/modify/{id}', [CandidatController::class, 'modify']);
            Route::post('/update', [CandidatController::class, 'update']);
        });

        Route::middleware(['role:admin'])->group(function () {
            Route::get('/', [CandidatController::class, 'all']);
            Route::get('/show/{id}', [CandidatController::class, 'show']);
            Route::delete('/{id}', [CandidatController::class, 'delete']);
        });
    });
    
    Route::group(['prefix' => 'cv'], function () {
        Route::middleware(['auth'])->group(function () {
            Route::get('/', [CvController::class, 'index']);
            Route::get('/show', [CvController::class, 'show']);
            Route::post('/upload', [CvController::class, 'upload']);
            Route::get('/download/{id}', [CvController::class, 'download'])->name('cv.download');
            Route::get('/preview/{id}', [CvController::class, 'preview'])->name('cv.preview');
            Route::get('/live', [CvController::class, 'live']);
            Route::post('/live', [CvController::class, 'livesubmit']);
        });
    });

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/index', [AdminController::class, 'dashboard']);   
});

Route::post('/admin/login', [AdminController::class, 'login']);

Route::group(['prefix' => 'mails'], function () {
    Route::get('/contactus', [MailController::class, 'contactus']);
    Route::post('/offre', [MailController::class, 'offre']);
    Route::get('/news', [MailController::class, 'news']);
    Route::post('/contact', [MailController::class, 'contact']);

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::post('/send', [MailController::class, 'send']);
    });
    
    Route::post('/postul', [MailController::class, 'postuler']);
    Route::post('/postuler', [MailController::class, 'postuler']);
});

Route::group(['prefix' => 'password'], function () {
    Route::get('/forgot', [App\Http\Controllers\Auth\PasswordController::class, 'showForgotForm']);
    Route::post('/email', [App\Http\Controllers\Auth\PasswordController::class, 'sendResetLink']);
    Route::get('/reset/{token}', [App\Http\Controllers\Auth\PasswordController::class, 'showResetForm']);
    Route::post('/reset', [App\Http\Controllers\Auth\PasswordController::class, 'reset']);
    Route::middleware(['auth'])->group(function () {
        Route::get('/change', [App\Http\Controllers\Auth\PasswordController::class, 'showChangeForm']);
        Route::post('/change', [App\Http\Controllers\Auth\PasswordController::class, 'change']);
    });
});

Route::get('/logins', function () {
    $user = Auth::user();
    if ($user != null) {
        if ($user->hasRole('candidat')) 
            return redirect('/candidats/index');
        return redirect('/admin/index');
    }
    return view('auth.login');
});

