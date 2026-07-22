@extends('layouts.front2')



@section('titre')

    {!! $meta['title'] !!}

@stop



@section('content')

  <div class="homsys-main-content">

    <div class="homsys-main-section homsys-about-text-full">

      <div class="container">

        <div class="row">

          <div class="col-md-6 homsys-typo-wrap">

            <div class="homsys-about-text">

              <h2>A propos</h2>

              <span class="homsys-about-sub">HOMSYS est une société de formation et de conseil en placement des ressources. </span>

              <p>Nous nous adressons aux entreprises ayant besoins de ressources qualifiées et opérationnelles immédiatement. </p>

              <p>En effet, nous prenons en charge le filtrage, la sélection et l’évaluation des profils répondant à vos besoins et exigences. </p>

              <p>HOMSYS vous offre une gamme complète de solutions de recrutement personnalisée en plus d’une expertise et l’attention que vous méritez.</p>

              <a href="#" class="homsys-static-btn homsys-bgcolor"><span>Contactez-Nous</span></a></div>

          </div>

          <div class="col-md-6 homsys-typo-wrap">

            <div class="homsys-about-thumb"><img src="{{ URL::asset('img/about-us-thumb.png')}}" alt="Contactez-Nous"></div>

          </div>

          <div class="col-md-12 homsys-typo-wrap">

            <div class="homsys-modren-counter">

              <ul class="row">

                <li class="col-md-4"> <i class="homsys-icon homsys-paper homsys-color"></i> <span class="word-counter">{{$nb_offres}}</span> <small>Offres</small></li>

                <li class="col-md-4"> <i class="homsys-icon homsys-resume-document homsys-color"></i> <span class="word-counter">{{$nb_cv}}</span> <small>Candidats</small></li>

                <li class="col-md-4"> <i class="homsys-icon homsys-briefcase homsys-color"></i> <span class="word-counter">{{$nb_clients}}</span> <small>Clients</small></li>

              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="homsys-main-section homsys-packages-priceplane-full">

      <div class="container">

        <div class="row">

          <div class="col-md-12 homsys-typo-wrap">

            <section id="service" class="homsys-fancy-title">

              <h2>Le recrutement !! C'est Notre Passion !!</h2>

              <p>Ce que nous distinque par rapport aux autres</p>

            </section>

          </div>

          <div class="col-md-4">

            <div class="homsys-classic-priceplane">

              <h2>Notre expérience</h2>

              <div class="homsys-priceplane-section">

                <p>Nous sommes reconnus pour notre expertise et notre réseau de contacts mais également pour notre accompagnement et notre approche personnalisés ainsi que pour notre créativité et notre ténacité pour cibler les bonnes personnes.</p>

              </div>

            </div>

          </div>

          <div class="col-md-4">

            <div class="homsys-classic-priceplane">

              <h2>Notre vaste réseau de contacts</h2>

              <div class="homsys-priceplane-section">

                <p>Notre vaste réseau de contacts nous permet d’accélérer le temps consacré à recruter, à sélectionner et à embaucher un candidat pour nos clients, un grand avantage puisque le temps est toujours un enjeu d’affaires important pour ceux-ci.</p>

              </div>

            </div>

          </div>

          <div class="col-md-4">

            <div class="homsys-classic-priceplane">

              <h2>Notre créativité</h2>

              <div class="homsys-priceplane-section">

                <p>Nous innovons constamment pour cibler, sélectionner et recruter la bonne personne. Nous sortons des sentiers battus ou conventionnels pour dénicher le profil idéal<br>

                  <br>

                  <br>

                </p>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="homsys-main-section homsys-plain-services-full">

      <div class="container">

        <div class="row">

          <div class="col-md-12">

            <section id="valeurs" class="homsys-fancy-title">

              <h2>NOS VALEURS</h2>

            </section>

            <div class="homsys-plain-services">

              <ul class="row">

                <li class="col-md-4" style="float:right"> <i class="homsys-icon homsys-curriculum"></i>

                  <h2>Expertise et accompagnement</h2>

                  <p> Fort de l’expérience et de l’expertise de ses équipes, HOMSYS apporte à ses clients un accompagnement global de leurs projets. Nous adaptons notre accompagnement à votre structure et à votre métier, pour répondre à vos besoins et pour faire face à l’accroissement des exigences réglementaires, comptables, fiscales et technologiques. HOMSYS vous conseille et vous assiste dans vos réflexions jusqu’à la mise en œuvre de vos projets d’évolution et/ou d’amélioration de la performance de votre organisation ou de votre système d’information.</p>

                </li>

                <li class="col-md-4"> <i class="homsys-icon homsys-search-1"></i>

                  <h2>La transparence</h2>

                  <p> La transparence nous amène à agir et à décider ouvertement. Elle assure le respect éthique et déontologique à ceux qui nous font confiance.</p>

                </li>

                <li class="col-md-4"> <i class="homsys-icon homsys-briefcase-1"></i>

                  <h2>La passion</h2>

                  <p> Notre passion donne un sens aux actions et nos actions contribuent à atteindre l’excellence dans chacun de nos mandats.</p>

                </li>

                <li class="col-md-4"> <i class="homsys-icon homsys-handshake"></i>

                  <h2>L’esprit d’équipe</h2>

                  <p> L’écoute, le dialogue, la confrontation des analyses pour cultiver la diversité des talents et des cultures. C’est la force de l’entreprise : être encore plus efficace ensemble.</p>

                </li>

                <li class="col-md-4"> <i class="homsys-icon homsys-building"></i>

                  <h2>La flexibilité</h2>

                  <p> Nous comprenons les contraintes de chacun client ou employé, et nous nous efforçons à nous adapter, à les rencontrer à mi-chemin pour solutionner une situation.</p>

                </li>

              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="homsys-main-section homsys-packages-priceplane-full">

      <div class="container">

        <div class="row">

          <div class="col-md-12 homsys-typo-wrap">

            <section id="methodologie" class="homsys-fancy-title">

              <h2>NOTRE MÉTHODOLOGIE </h2>

            </section>

            <div class="homsys-services-classic">

              <ul class="row">

                <li class="col-md-4"> <span><i class="homsys-icon homsys-handshake"></i></span>

                  <h2>1-Ecouter et conseiller</h2>

                  <p align="left">

                    Notre première approche consiste à analyser votre contexte interne (projets, équipe en place, technologies, environnements…). Nous vous conseillons sur l’attitude à adopter sur le marché

                  </p>

                </li>

                <li class="col-md-4"> <span><i class="homsys-icon homsys-curriculum"></i></span>

                  <h2>2-Chercher sur mésure</h2>

                  <p id="mesure-less" align="left">

                    Chaque recherche est différente. Nous adaptons donc notre communication autour de trois grands axes en fonction de votre besoin. Communiquer : Nous diffusons votre offre à un large panel sur la toile ... <a id="btn_more_mesure">En savoir plus</a>

                  </p>

                  <p id="mesure-more" style="display: none;" align="left">

                    Chaque recherche est différente.

                    Nous adaptons donc notre communication autour de trois grands axes en fonction de votre besoin.

                    Communiquer : Nous diffusons votre offre à un large panel sur la toile (annonce rédigée sur mesure en fonction de votre besoin) ;

                    « Réseauter » : Etant spécialisé sur votre métier, notre réseau est exclusivement composé de profils travaillant dans ce domaine. Nous faisons donc appel à notre propre réseau via notre base de données, mais aussi à nos connexions sur les réseaux sociaux ;

                    Chasser : En fonction des profils recherchés, nous travaillons par approche directe pour une recherche plus ciblée.<a id="btn_less_mesure">En savoir moins</a>

                  </p>

                </li>

                <li class="col-md-4"> <span><i class="homsys-icon homsys-resume-document"></i></span>

                  <h2>3-Proposer et recommander</h2>



                  <p id="proposer-less" align="left">Après une approche globale sur le marché du recrutement, notre objectif est de vous proposer plusieurs candidats ciblés. Dans cet objectif nous qualifions dans les détails les candidats pour s’assurer ...

                    <a id="btn_more_proposer">En savoir plus</a>

                  </p>

                  <p id="proposer-more" style="display: none;" align="left">Après une approche globale sur le marché du recrutement, notre objectif est de vous proposer plusieurs candidats ciblés.

                        Dans cet objectif nous qualifions dans les détails les candidats pour s’assurer : de leurs compétences, de leur motivation, de leurs contraintes et de l’adéquation avec votre offre.

                    <a id="btn_less_proposer">En savoir moins</a>

                  </p>



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

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(e) {

        $('#btn_more_proposer').click(function(){

            $("#proposer-less").hide();

            $("#proposer-more").show();

        });



        $('#btn_less_proposer').click(function(){

            $("#proposer-less").show();

            $("#proposer-more").hide();

        });



        $('#btn_more_mesure').click(function(){

            $("#mesure-less").hide();

            $("#mesure-more").show();

        });



        $('#btn_less_mesure').click(function(){

            $("#mesure-less").show();

            $("#mesure-more").hide();

        });



    });

</script>



@stop

