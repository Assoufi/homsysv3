<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    public function index()
    {
        $baseUrl = rtrim(config('app.url'), '/');

        $urls = [];

        // Static pages
        $staticPages = [
            '/' => ['changefreq' => 'weekly', 'priority' => '1.0'],
            '/offres' => ['changefreq' => 'daily', 'priority' => '0.9'],
            '/about' => ['changefreq' => 'monthly', 'priority' => '0.6'],
            '/portage' => ['changefreq' => 'monthly', 'priority' => '0.5'],
            '/mails/contactus' => ['changefreq' => 'monthly', 'priority' => '0.5'],
            '/candidats/spontane' => ['changefreq' => 'monthly', 'priority' => '0.7'],
        ];

        foreach ($staticPages as $path => $config) {
            $urls[] = array_merge(['loc' => $baseUrl . $path], $config);
        }

        // Job listings
        $offres = Offre::where('exp_offre', 0)
            ->orderBy('updated_at', 'desc')
            ->get(['id_offre', 'titre_offre', 'updated_at']);

        foreach ($offres as $offre) {
            $slug = Str::slug($offre->titre_offre);
            $lastmod = null;
            if (!empty($offre->updated_at)) {
                $lastmod = Carbon::parse($offre->updated_at)->toAtomString();
            }
            $urls[] = [
                'loc' => $baseUrl . '/offres/' . $offre->id_offre . '-' . $slug,
                'lastmod' => $lastmod,
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . e($u['loc']) . "</loc>\n";
            if (!empty($u['lastmod'])) {
                $xml .= '    <lastmod>' . e($u['lastmod']) . "</lastmod>\n";
            }
            $xml .= '    <changefreq>' . e($u['changefreq']) . "</changefreq>\n";
            $xml .= '    <priority>' . e($u['priority']) . "</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= "</urlset>\n";

        return Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
