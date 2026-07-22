<?php

namespace App\Http\View\Composers;

use App\Models\Offre;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class GlobalDataComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        if (app()->runningInConsole()) {
            return;
        }

        if (!Schema::hasTable('offres')) {
            return;
        }

        // These datasets are displayed across multiple pages; caching avoids repeating
        // the same queries on every single request.
        $active_offres = Cache::remember('shared.offres.active', 300, function () {
            return Offre::where('exp_offre', 0)->orderBy('updated_at', 'desc')->get();
        });
        $view->with('active_offres', $active_offres);

        $offres_news = Cache::remember('shared.offres.news', 300, function () {
            return Offre::where('exp_offre', 0)->orderBy('updated_at', 'desc')->take(7)->get();
        });
        $view->with('offres_news', $offres_news);

        try {
            $visites_offre = Cache::remember('shared.stats.visites_offre', 300, function () {
                // vistes_offre seems like a typo in original code, but I'll keep it as is or fix it if I'm sure
                // Original code had: DB::select('SELECT * from vistes_offre order by id_offre desc LIMIT 30');
                return DB::select('SELECT * from vistes_offre order by id_offre desc LIMIT 30');
            });
            $view->with('visites_offre', $visites_offre);
        } catch (\Throwable) {
            // Optional dataset: depends on DB views existing.
        }

        try {
            $visite_jour = Cache::remember('shared.stats.visite_jour', 300, function () {
                return DB::select('SELECT * from visite_jour order by jour desc LIMIT 20');
            });
            $view->with('visite_jour', $visite_jour);
        } catch (\Throwable) {
            // Optional dataset: depends on DB views existing.
        }
    }
}
