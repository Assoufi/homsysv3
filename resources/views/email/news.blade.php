<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
      <title>Contact</title>
      <meta http-equiv="Content-Type" content="text/html"  charset="UTF-8"/>
  </head>
  <body>
    <div>
      <h3>Dernières offres</h3>
      @if( empty($offres_news ))
       @foreach($offres_news as $offre)
           <article>
               <h4><a href="https://homsys.ma/offres/{{$offre->id_offre}}">{!!$offre->titre_offre!!}</a></h4>
           </article>
        @endforeach
        @endif
        <hr>
        <p><a href="www.homsys.ma">HOMSYS</a></p>
    </div>
  </body>
</html>
