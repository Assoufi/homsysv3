@extends('layouts.front2')

@section('titre')
    Faites le choix d'un partenaire fiable
@stop

@section('content')
  <div class="homsys-main-content">
    <div class="homsys-main-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 homsys-typo-wrap">
            <section class="homsys-fancy-title">
              <h2>Dernières offres publiées</h2>
              <p>Retrouvez ici les dernières offres publiées</p>
            </section>
            <div class="homsys-job-listing homsys-featured-listing">
              <ul class="homsys-row">
                @if( empty($lastest_offres ))
                    <li class="list-group-item">Aucune offre disponible</li>
                @else
                @foreach( $lastest_offres as $offre)
                <li class="homsys-column-6">
                  <div class="homsys-table-layer">
                    <div class="homsys-table-row">
                      <div class="homsys-featured-listing-text">
                        <h2><a href="{{url('offres',['id'=>$offre->id_offre.'-'.strtolower(str_replace(str_split("'\\/:*?|+%."), '_', $offre->titre_offre))])}}">{{$offre->titre_offre}}</a></h2>
                         <i class="fa fa-heart"></i>                        
                        <div class="homsys-featured-listing-options">
                           <ul>
                             <li><i class="fa fa-map-marker"></i> {{$offre->ville_offre}}, Maroc</li>
                             <li><i class="fa fa-calendar"></i> {{$offre->duree}}</li>
                           </ul>
                           <a href="{{url('offres',['id'=>$offre->id_offre])}}" class="homsys-option-btn">{{$offre->type_offre}}</a> </div>
                      </div>
                    </div>
                  </div>
                </li>
                @endforeach
                @endif
              </ul>
            </div>
            <div class="homsys-plain-btn"> <a href="{{url('offres')}}">Voir toutes les offres</a> </div>
          </div>
        </div>
      </div>
    </div>    
    <br>
    <div class="homsys-main-section homsys-counter-full">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="homsys-counter">
              <ul class="row">
                   <li class="col-md-4"> <i class="fa fa-file"></i> <span class="word-counter">{{$nb_offres}}</span> <small>Offres publiées</small></li>
                  <li class="col-md-4"> <i class="fa fa-user"></i> <span class="word-counter">{{$nb_cv}}</span> <small>Candidatures reçues</small></li>
                  <li class="col-md-4"> <i class="fa fa-briefcase"></i> <span class="word-counter">{{$nb_clients}}</span> <small>Clients servis</small></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>    
    <div class="homsys-main-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <section class="homsys-fancy-title" id="actualites">
              <h2>Actualités</h2>
            </section>
            <div class="homsys-blog homsys-blog-grid">
              <ul class="row">
                <li class="col-md-4">
                  <figure><a href="#"><img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"></a></figure>
                  <div class="homsys-blog-grid-text">                
                    <h2><a href="{{ url('/article1') }}">L'intelligence artificielle dans le recrutement : comment adapter sa candidature en 2026 ?</a></h2>                    
                    <p>Les outils d'intelligence artificielle trient désormais la majorité des CV et organisent des pré-entretiens vidéo automatisés. Comprendre leur fonctionnement et optimiser son profil en conséquence est devenu indispensable pour ne pas être éliminé avant même d'atteindre un recruteur humain.</p>
                    <a href="{{ url('/article1') }}" class="homsys-read-more homsys-bgcolor">Lire la suite</a> </div>
                </li>
                <li class="col-md-4">
                  <figure><a href="#"><img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40" alt="teletravail hybride"></a></figure>
                  <div class="homsys-blog-grid-text">                    
                    <h2><a href="{{ url('/article2') }}">Télétravail hybride : les nouvelles règles pour négocier sa flexibilité professionnelle</a></h2>                    
                    <p>Le travail hybride s'est imposé comme un standard dans de nombreuses entreprises. Savoir présenter ses arguments pour obtenir le rythme qui préserve à la fois sa productivité et son équilibre de vie est une compétence clé pour les candidats comme pour les salariés.</p>
                    <a href="{{ url('/article2') }}" class="homsys-read-more homsys-bgcolor">Lire la suite</a> </div>
                </li>
                <li class="col-md-4">
                  <figure><a href="#"><img src="{{ URL::asset('img/mode_travail_freelance.jpg')}}" alt="reconversion professionnelle"></a></figure>
                  <div class="homsys-blog-grid-text">                    
                    <h2><a href="{{ url('/article3') }}">Reconversion professionnelle à 30, 40 ou 50 ans : les stratégies qui fonctionnent aujourd'hui</a></h2>                    
                    <p>Les transitions de carrière sont de plus en plus fréquentes face aux mutations technologiques rapides. Loin des clichés sur l'âge, cet article aborde les étapes concrètes — bilan de compétences, formations ciblées, valorisation de l'expérience — pour réussir un changement de métier à tout âge.</p>
                    <a href="{{ url('/article3') }}" class="homsys-read-more homsys-bgcolor">Lire la suite</a> </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="homsys-main-section homsys-parallex-text-full">
      <div class="container">
        <div class="row">
          <aside class="col-md-6 homsys-typo-wrap">
            <div class="homsys-parallex-text homsys-logo-text">
              <h2>Nos références </h2>
              <p>Depuis 2009, les plus grands acteurs du marché ont fait confiance à HOMSYS et sont devenues des clients fidèles, une liste non exhaustive de nos clients : </p>
              <a href="{{ url('mails/contactus') }}" class="homsys-static-btn homsys-bgcolor"><span>Contactez-nous</span></a> </div>
          </aside>
          <aside class="col-md-6 homsys-typo-wrap">
            <div class="homsys-logo-thumb"><img src="{{ URL::asset('img/references.jpg')}}" alt="references"></div>
          </aside>
        </div>
      </div>
    </div>
  </div>
@endsection
