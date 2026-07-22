<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <title>Candidature</title>
    <meta http-equiv="Content-Type" content="text/html"  charset="UTF-8"/>
</head>
<body>
    <div align = "left">
        <h3>{{ $titre }}</h3>
        <p>Candidature pour l'offre : {{ $titre }}</p>
        <p>Envoyée par : {{ $nom }}</p>
        <p>Email : {{ $email }}</p>
        <p>Tél : {{ $telephone }}</p>
        <p>TJM : {{ $tjm }}</p>
        <p>Disponibilité : {{ $disponibilite }}</p>
        <p>Date :  {{date("d/m/Y H:i:s")}}</p>
        @if(!empty($texto))
        <hr>Message : <br>
        <p align="justify">{!! nl2br(e($texto)) !!}</p>
        <hr>
        @endif
    </div>
</body>
</html>
