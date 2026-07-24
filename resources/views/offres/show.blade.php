@extends('layouts.front2')

@section('titre')
    {!! $meta['title'] !!}
@stop

@section('scripts')
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org/",
      "@@type": "JobPosting",
      "title": "{{ $offre->titre_offre }}",
      "description": "{!! addslashes(strip_tags($offre->poste . ' ' . $offre->profil . ' ' . $offre->competences)) !!}",
      "datePosted": "{{ $offre->created_at->toIso8601String() }}",
      "validThrough": "{{ $offre->updated_at->addMonths(3)->toIso8601String() }}",
      "employmentType": "{{ match($offre->type_offre) { 'Freelance' => 'CONTRACTOR', 'CDD' => 'TEMPORARY', 'Stage' => 'INTERN', default => 'FULL_TIME' } }}",
      "hiringOrganization": {
        "@@type": "Organization",
        "name": "HOMSYS",
        "sameAs": "https://www.homsys.ma",
        "logo": "{{ URL::asset('img/logo.png') }}"
      },
      "jobLocation": {
        "@@type": "Place",
        "address": {
          "@@type": "PostalAddress",
          "addressLocality": "{{ $offre->ville_offre ?? 'Maroc' }}",
          "addressCountry": "MA"
        }
      }
    }
    </script>

    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "BreadcrumbList",
      "itemListElement": [
        {"@@type": "ListItem", "position": 1, "name": "Accueil", "item": "{{ url('/') }}"},
        {"@@type": "ListItem", "position": 2, "name": "Offres", "item": "{{ url('offres') }}"},
        {"@@type": "ListItem", "position": 3, "name": "{{ $offre->titre_offre }}"}
      ]
    }
    </script>
@stop

@section('content')
<div class="homsys-main-content">
  <div class="homsys-main-section">
    <div class="container">
      <div class="row">

        {{-- Main Content --}}
        <div class="homsys-column-8">
          <div class="homsys-typo-wrap">
            <figure class="homsys-jobdetail-list">
              <figcaption>
                <h2>{{ $offre->titre_offre }}</h2>
              </figcaption>
            </figure>

            <div class="homsys-jobdetail-content">

              @if(!empty($offre->poste))
                <div class="homsys-content-title"><h2>Mission :</h2></div>
                <div class="homsys-description"><p>{!! $offre->poste !!}</p></div>
              @endif

              @if(!empty($offre->profil))
                <div class="homsys-content-title"><h2>Profil :</h2></div>
                <div class="homsys-description"><p>{!! $offre->profil !!}</p></div>
              @endif

              @if(!empty($offre->competences))
                <div class="homsys-content-title"><h2>Compétences demandées :</h2></div>
                <div class="homsys-description">{!! $offre->competences !!}</div>
              @endif

              @if(!empty($offre->qualites))
                <div class="homsys-content-title"><h2>Qualités personnelles demandées :</h2></div>
                <div class="homsys-description">{!! $offre->qualites !!}</div>
              @endif

              @if(!empty($offre->description_offre))
                <div class="homsys-content-title"><h2>Détails :</h2></div>
                <div class="homsys-description">{!! $offre->description_offre !!}</div>
              @endif

              <div class="homsys-sticky-cta d-md-none mt-4">
                <a href="{{ url('offres/postule', $offre->id_offre) }}" class="btn btn-lg homsys-bgcolor text-white btn-block">
                  <i class="fa fa-paper-plane"></i> POSTULER
                </a>
              </div>

              <div class="d-none d-md-block mt-4">
                <a href="{{ url('offres/postule', $offre->id_offre) }}" class="homsys-applyjob-btn">
                  POSTULER
                </a>
              </div>

              <div class="sharethis-inline-share-buttons mt-3"></div>
            </div>
          </div>
        </div>

        {{-- Sidebar --}}
        <aside class="homsys-column-4">
          <div class="homsys-typo-wrap">
            <figure class="homsys-jobdetail-list">
              <figcaption>
                <ul>
                  <li><i class="fa fa-id-card-o"></i> Contrat : {{ $offre->type_offre }}</li>
                  @if(!empty($offre->ville_offre))
                    <li><i class="fa fa-map-marker"></i> Localisation : {{ $offre->ville_offre }}</li>
                  @endif
                  @if(!empty($offre->duree))
                    <li><i class="fa fa-clock-o"></i> Durée : {{ $offre->duree }}</li>
                  @endif
                  @if(!empty($offre->date_demarrage))
                    <li><i class="fa fa-calendar"></i> Démarrage : {{ $offre->date_demarrage }}</li>
                  @endif
                  @if(!empty($offre->experience))
                    <li><i class="fa fa-line-chart"></i> Expérience : {{ $offre->experience }} ans</li>
                  @endif
                  @if(!empty($offre->formation))
                    <li><i class="fa fa-graduation-cap"></i> Formation : {{ $offre->formation }}</li>
                  @endif
                  <li><i class="fa fa-calendar"></i> Publiée le : {{ $offre->updated_at->format('d/m/Y') }}</li>
                </ul>
              </figcaption>
            </figure>
          </div>

          <div class="homsys-typo-wrap">
            <div class="widget_apply_job_wrap">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <a href="{{ url('offres/postule', $offre->id_offre) }}" class="btn btn-success btn-block">
                  <i class="fa fa-paper-plane"></i> POSTULER
                </a>
              </div>
              <div>&nbsp;</div>
              <div class="homsys-applywith-title"><small>ou partager sur</small></div>
              <div class="sharethis-inline-share-buttons"></div>
              <div>&nbsp;</div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <a href="{{ url('offres') }}" class="btn btn-warning btn-block">
                  <i class="fa fa-caret-square-o-left"></i> Retour
                </a>
              </div>
            </div>
          </div>
        </aside>

      </div>
    </div>
  </div>
</div>
@stop

@push('styles')
<style>
  .homsys-sticky-cta {
    position: sticky;
    bottom: 0;
    z-index: 10;
    background: #fff;
    padding: 12px 0;
    box-shadow: 0 -2px 8px rgba(0,0,0,0.1);
  }
</style>
@endpush
