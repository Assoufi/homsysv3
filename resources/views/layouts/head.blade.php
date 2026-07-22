<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Language" content="fr">

    <!-- Primary Meta Tags -->
    @php
        $siteName = 'HOMSYS';
        $title = View::getSection('titre') ?: ($meta['title'] ?? 'Faites le choix d\'un partenaire fiable');
        $description = $meta['description'] ?? 'Les meilleures missions en freelance en Développement, Gestion de projets, AMOA, MOE, DBA ... au Maroc sont sur homsys.ma';
        $canonical = request()->fullUrl();
    @endphp

    <title>{{ $title }} | {{ $siteName }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="author" content="{{ $siteName }}">
    <link rel="canonical" href="{{ $canonical }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ URL::asset('img/logo-homsys-sigle.png') }}">
    <meta property="og:site_name" content="{{ $siteName }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ $canonical }}">
    <meta property="twitter:title" content="{{ $title }}">
    <meta property="twitter:description" content="{{ $description }}">
    <meta property="twitter:image" content="{{ URL::asset('img/logo-homsys-sigle.png') }}">

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@type": "Organization",
      "name": "{{ $siteName }}",
      "url": "{{ url('/') }}",
      "logo": "{{ URL::asset('img/logo.png') }}",
      "sameAs": [
        "https://linkedin.com/company/homsys-maroc",
        "https://www.facebook.com/Homsys-230140987182373/",
        "https://twitter.com/HomsysMaroc"
      ]
    }
    </script>

    <link rel="icon" href="{{ URL::asset('favicon.png') }}" type="image/png">

    <!-- CSS and JS -->
    @include('css_js')
    <link rel="stylesheet" href="{{ asset('css/flash-notifications.css') }}">
</head>

