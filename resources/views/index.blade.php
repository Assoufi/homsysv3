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
                  <figure><a href="#"><img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Réussir son entretien d'embauche" loading="lazy"></a></figure>
                  <div class="homsys-blog-grid-text">                
                    <h2><a href="{{ url('/article1') }}">Comment réussir son entretien d’embauche : conseils pratiques</a></h2>                    
                    <p>Un entretien d'embauche est une étape cruciale dans la recherche d'emploi. Pour maximiser vos chances de succès, une bonne préparation est essentielle. Voici nos conseils pratiques pour aborder sereinement cette rencontre et faire la meilleure impression possible.</p>
                    <a href="{{ url('/article1') }}" class="homsys-read-more homsys-bgcolor">Lire la suite</a> </div>
                </li>
                <li class="col-md-4">
                  <figure><a href="#"><img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40" alt="conseils indispensables pour un CV percutant" loading="lazy"></a></figure>
                  <div class="homsys-blog-grid-text">                    
                    <h2><a href="{{ url('/article2') }}">10 conseils indispensables pour un CV percutant</a></h2>                    
                    <p>Vous avez déjà postulé à plusieurs annonces, pour différentes missions et différents secteurs d’activité, mais vos candidatures ne se sont jamais concrétisées ? Et si cela venait de votre CV ? Voici 10 recommandations pour éviter les pièges les plus "classiques", les faux pas, et présenter un CV bien construit. </p>
                    <a href="{{ url('/article2') }}" class="homsys-read-more homsys-bgcolor">Lire la suite</a> </div>
                </li>
                <li class="col-md-4">
                  <figure><a href="#"><img src="{{ URL::asset('img/mode_travail_freelance.jpg')}}" alt="Avantages du freelance" loading="lazy"></a></figure>
                  <div class="homsys-blog-grid-text">                    
                    <h2><a href="{{ url('/article3') }}">Les avantages que ne connaissent pas les développeurs en CDI</a></h2>                    
                    <p>Etre développeur est une chance incroyable. Enfin, la chance n’est que la rencontre entre le travail et l’opportunité, n’est-ce pas ? Ainsi, rien ne vous empêche de vivre pleinement votre vie de développeur. Développeurs web, mobile, logiciel, front-end, back-end, full-stack... exploitez-vous réellement au maximum le potentiel de votre métier ? </p>
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
            <div class="homsys-logo-thumb"><img src="{{ URL::asset('img/references.jpg')}}" alt="Nos références clients" loading="lazy"></div>
          </aside>
        </div>
      </div>
    </div>
  </div>
@endsection
