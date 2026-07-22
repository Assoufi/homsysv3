<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @php
        $urls = [
            'https://homsys.ma/',
            'https://homsys.ma/offres',
            'https://homsys.ma/candidats/spontane',
            'https://homsys.ma/portage',
            // Ajoutez d'autres URLs si nécessaire
        ];
    @endphp

    @foreach ($urls as $url)
        <url>
            <loc>{{ $url }}</loc>
            <lastmod>{{ \Carbon\Carbon::now()->toW3cString() }}</lastmod>            
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach

@foreach($offres as $offre)
    <url>
        <loc>{{url('offres',['id'=>$offre->id_offre])}}</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($offre->updated_at)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
@endforeach


</urlset>
