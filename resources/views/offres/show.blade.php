@extends('layouts.front2')



@section('titre')
    {!! $meta['title'] !!}
@stop

@section('scripts')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "JobPosting",
      "title": "{{ $offre->titre_offre }}",
      "description": "{!! addslashes(strip_tags($offre->poste . ' ' . $offre->profil . ' ' . $offre->competences)) !!}",
      "datePosted": "{{ $offre->created_at->toIso8601String() }}",
      "validThrough": "{{ $offre->updated_at->addMonths(3)->toIso8601String() }}",
      "employmentType": "{{ $offre->type_offre == 'Freelance' ? 'CONTRACTOR' : 'FULL_TIME' }}",
      "hiringOrganization": {
        "@type": "Organization",
        "name": "HOMSYS",
        "sameAs": "https://www.homsys.ma",
        "logo": "{{ URL::asset('img/logo.png') }}"
      },
      "jobLocation": {
        "@type": "Place",
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "{{ $offre->ville_offre ?? 'Maroc' }}",
          "addressCountry": "MA"
        }
      }
    }
    </script>
@append

@section('content')



    <div class="homsys-main-content">

      <div class="homsys-main-section">

        <div class="container">

          <div class="row">

            <div class="homsys-column-8">

              <div class="homsys-typo-wrap">

                <div class="homsys-typo-wrap">

                  <figure class="homsys-jobdetail-list">

                    <figcaption>

                      <h2>{{$offre->titre_offre}} </h2>

                    </figcaption>

                  </figure>

                </div>

                <div class="homsys-jobdetail-content">

                  @if(!empty($offre->poste))

                  <div class="homsys-content-title">

                    <h2>Mission : </h2>

                  </div>

                  <div class="homsys-description">

                    <p>{!! $offre->poste !!}</p>

                  </div>

                  @endif

                  @if(!empty($offre->profil))

                  <div class="homsys-content-title">

                    <h2>Profil :</h2>

                  </div>

                  <div class="homsys-description">

                    <p>{!! $offre->profil !!}</p>

                  </div>

                  @endif

                  @if(!empty($offre->competences))

                  <div class="homsys-content-title">

                    <h2>Compétences demandées : </h2>

                  </div>

                  <div class="homsys-description">

                    {!! $offre->competences !!}

                  </div>

                  @endif

                  @if(!empty($offre->qualites))

                  <div class="homsys-content-title">

                    <h2>Qualités personnelles demandées :</h2>

                  </div>

                  <div class="homsys-description">

                    {!! $offre->qualites !!}

                  </div>

                  @endif

                  @if(!empty($offre->description_offre))

                  <div class="homsys-content-title">

                    <h2>Détails : </h2>

                  </div>

                  <div class="homsys-description">

                    {!! $offre->description_offre !!}

                  </div>

                  @endif

                  <div>

                    <a href="{{url('offres/postule/'.$offre->id_offre)}}" class="homsys-applyjob-btn" style="margin-top:30px;"> POSTULER</a>

                    <!-- ShareThis BEGIN -->

                    <div class="sharethis-inline-share-buttons"></div>

                    <!-- ShareThis END -->

                  </div>

                </div>

              </div>

            </div>



            <aside class="homsys-column-4">

              <div class="homsys-typo-wrap">

                <figure class="homsys-jobdetail-list">

                  <figcaption>

                    <ul>

                      <li><i class="fa fa-id-card-o" aria-hidden="true"></i> Contrat : {{$offre->type_offre}}</li>

                      @if(!empty($offre->ville_offre))

                      <li><i class="fa fa-map-marker"></i> Localisation : {{$offre->ville_offre}}</li>

                      @endif

                      @if(!empty($offre->duree))

                      <li><i class="fa fa-clock-o" aria-hidden="true"></i> Durée : {{$offre->duree}}</li>

                      @endif

                      @if(!empty($offre->date_demarrage))

                      <li><i class="homsys-icon homsys-calendar"></i> Démarrage : {{$offre->date_demarrage}}</li>

                      @endif

                      @if(!empty($offre->experience))

                      <li><i class="fa fa-arrows-alt" aria-hidden="true"></i> Expérience : {{$offre->experience}} ans</li>

                      @endif

                      @if(!empty($offre->formation))

                      <li><i class="fa fa-graduation-cap" aria-hidden="true"></i> Formation : {{$offre->formation}}</li>

                      @endif

                      <!--<li><i class="homsys-icon homsys-calendar"></i> Offre publiée le : {{ $offre->updated_at?->format('d/m/Y') ?? 'N/A' }}

                      </li>

                    -->

                    </ul>

                  </figcaption>

                </figure>

              </div>





              <div class="homsys-typo-wrap">

                <div class="widget_apply_job_wrap">

                  <div class="col-md-12 col-sm-12 col-xs-12">

                    <a href="{{url('offres/postule/'.$offre->id_offre)}}" class="btn btn-success btn-block"> POSTULER </a>

                  </div>

                  <div>&nbsp;</div>

                  <div class="homsys-applywith-title"><small>ou partager sur</small></div>

                  <div class="sharethis-inline-share-buttons"></div>

                    <!--<div class="row">

                    <div class="col-sm-3">

                      <a href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&title={{$offre->titre_offre}}&source=www.homsys.ma" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-linkedin"></i> Linkedin</a>

                    </div>

                    <div class="col-sm-3">

                      <a href="https://www.facebook.com/sharer.php?u={{Request::url()}}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-facebook-official"></i> Facebook</a>

                    </div>

                    <div class="col-sm-3">

                      <a href="https://web.whatsapp.com/send?l=en&text={{Request::url()}}&title={{$offre->titre_offre}}&source=www.homsys.ma" data-action="share/whatsapp/share" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-whatsapp"></i> Whatsapp</a>

                    </div>

                    <div class="col-sm-3">

                      <a href="https://twitter.com/intent/tweet?text={{$offre->titre_offre}}+'=>'+{{Request::url()}}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-twitter"></i> Twitter</a>

                    </div>

                    </div>-->

                  <div>&nbsp;</div>

                  <div class="col-md-12 col-sm-12 col-xs-12">

                    <a href="{{url('offres')}}"" class="btn btn-warning btn-block"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Retour</a>

                  </div>

                </div>

                          <!--@if (!Auth::guest())

                          <a href="#" class="homsys-sendmessage-btn"><i class="homsys-icon homsys-envelope"></i> Envoyer à un(e) ami(e)</a>

                          @endif

                        -->

              </div>

                        <!--

                      <div class="widget jobsearch_widget_map">

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1209.6767242832536!2d-7.627925487928419!3d33.57728459249334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7cd4778aa113b%3A0xb06c1d84f310fd3!2sCasablanca!5e0!3m2!1sfr!2sma!4v1593714127158!5m2!1sfr!2sma" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                      </div>

                      <ul class="homsys-jobdetail-media">

                        <li><span>Partager cette offre :</span></li>

                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&title={{$offre->titre_offre}}&source=www.homsys.ma" target="_blank" data-original-title="linkedin" class="homsys-icon homsys-linkedin"></a></li>

                        <li><a href="https://twitter.com/intent/tweet?text={{$offre->titre_offre}}+'=>'+{{Request::url()}}"

                                   target="_blank" data-original-title="twitter" class="homsys-icon homsys-twitter-circular-button"></a></li>

                        <li><a href="https://www.facebook.com/sharer.php?u={{Request::url()}}"

                                   target="_blank" data-original-title="facebook" class="homsys-icon homsys-facebook-logo-in-circular-button-outlined-social-symbol"></a></li>



                      </ul>-->

            </aside>











          </div>

        </div>

      </div>

    </div>

  </div>



@stop

@section('scripts')

  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

  <script>



      var popupSize = {

          width: 780,

          height: 550

      };



      $(document).on('click', '.social-buttons > a', function(e){



          var

                  verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),

                  horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);



          var popup = window.open($(this).prop('href'), 'social',

                  'width='+popupSize.width+',height='+popupSize.height+

                  ',left='+verticalPos+',top='+horisontalPos+

                  ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');



          if (popup) {

              popup.focus();

              e.preventDefault();

          }



      });



      /*$("#bb").click(function(event){

          alert('momoo')

      event.preventDefault(); //prevent default action

      var post_url = $(this).attr("action"); //get form action url

      var request_method = $(this).attr("method"); //get form GET/POST method

      var form_data = new FormData(this); //Creates new FormData object

      $.ajax({

          url : post_url,

          type: request_method,

          data : form_data,

          contentType: false,

          cache: false,

          processData:false

      },

      success: function (data) {

                  //$("#centralModalSuccess").modal();

                  //$("#date_fin").val("");

                  //$("#date_debut").val("");

                  alert('cocoooo');

              },

              error: function (data) {

                  var errors = data.responseJSON;

                  console.log(errors);

              }

      );

  });*/





  </script>

@stop

