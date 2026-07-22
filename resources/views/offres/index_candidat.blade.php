@extends('layouts.front2')

@section('titre')

     {!! $meta['title'] !!}

    @stop

@section('content')

  <div class="homsys-main-section">

      <div class="container">

        <div class="row">

          <aside class="homsys-column-3 homsys-typo-wrap">

            <div class="homsys-typo-wrap">

              <form class="homsys-search-filter">

                <div class="homsys-search-filter-wrap homsys-without-toggle" style="display:none">

                  <h2><a href="#">Catégories</a></h2>

                  <div class="homsys-search-box" >

                    <input value="Recherche" onBlur="if(this.value == '') { this.value ='Recherche'; }" onFocus="if(this.value =='Recherche') { this.value = ''; }" type="text">

                    <input type="submit" value="">

                    <i class="homsys-icon homsys-search"></i> </div>

                  <ul class="homsys-checkbox">

                    <li>

                      <input type="checkbox" id="r01" name="rr" />

                      <label for="r01"><span></span>UX/UI Design </label>

                    </li>

                    <li>

                      <input type="checkbox" id="r02" name="rr" />

                      <label for="r02"><span></span>Développement Web </label>

                    </li>

                    <li>

                      <input type="checkbox" id="r03" name="rr" />

                      <label for="r03"><span></span>Développement Mobile </label>

                    </li>

                    <li>

                      <input type="checkbox" id="r04" name="rr" />

                      <label for="r04"><span></span>Data et bases de données </label>

                    </li>

                    <li>

                      <input type="checkbox" id="r05" name="rr" />

                      <label for="r05"><span></span>Réseaux & Télécom </label>

                    </li>

                    <li>

                      <input type="checkbox" id="r06" name="rr" />

                      <label for="r06"><span></span>Formation Professionnelle </label>

                    </li>

                    <li>

                      <input type="checkbox" id="r07" name="rr" />

                      <label for="r07"><span></span>Finances & Assurances </label>

                    </li>

                    <li>

                      <input type="checkbox" id="r08" name="rr" />

                      <label for="r08"><span></span>Ingénierie et BTP </label>

                    </li>

                  </ul>

                </div>

                <div class="homsys-search-filter-wrap homsys-search-filter-toggle" style="display:none">

                  <h2>Type de Contrat</h2>

                  <div class="homsys-checkbox-toggle">

                    <ul class="homsys-checkbox">

                      <li>

                        <input type="checkbox" name="types[]" value="Freelance"/>

                        <label for="r11"><span></span>Freelance</label>

                        <small>13</small> </li>

                      <li>

                        <input type="checkbox" name="types[]" value="CDI"/>

                        <label for="r12"><span></span>CDI </label>

                        <small>4</small> </li>

                      <li>

                        <input type="checkbox" name="types[]" value="CDD"/>

                        <label for="r13"><span></span>CDD </label>

                        <small>12</small> </li>

                      <li>

                        <input type="checkbox" name="types[]" value="Stage"/>

                        <label for="r14"><span></span>Stage </label>

                        <small>22</small> </li>

                    </ul>

                  </div>

                </div>

                <div class="homsys-search-filter-wrap homsys-search-filter-toggle" style="display:none">

                  <h2><a href="#" class="homsys-click-btn">Localité</a></h2>

                  <div class="homsys-checkbox-toggle">

                    <ul class="homsys-checkbox">

                      <li>

                        <input type="checkbox" id="r17" name="rr" />

                        <label for="r17"><span></span>Casablanca</label>

                        <small>10</small> </li>

                      <li>

                        <input type="checkbox" id="r18" name="rr" />

                        <label for="r18"><span></span>Rabat</label>

                        <small>2</small> </li>

                      <li>

                        <input type="checkbox" id="r19" name="rr" />

                        <label for="r19"><span></span>khouribga</label>

                        <small>6</small> </li>

                      <li>

                        <input type="checkbox" id="r20" name="rr" />

                        <label for="r20"><span></span>Abidjan </label>

                        <small>4</small> </li>

                      <li>

                        <input type="checkbox" id="r21" name="rr" />

                        <label for="r21"><span></span>Paris</label>

                        <small>19</small> </li>

                    </ul>

                  </div>

                </div>

              </form>

            </div>

          </aside>

          <div class="homsys-column-9 homsys-typo-wrap">

            <div class="homsys-typo-wrap">

              <div class="homsys-filterable">

                <h2>{{$nb_offres}} Offres trouvées</h2>

              </div>

              <div class="homsys-job homsys-joblisting-classic">

                <ul class="homsys-row">

                  @php $now = Carbon\Carbon::now(); @endphp

                  @foreach($offres as $offre)

                  <li class="homsys-column-12">

                    <div class="homsys-joblisting-classic-wrap">

                      <div class="homsys-joblisting-text">

                        <div class="homsys-list-option">

                          <h2><a href="{{url('offres',['id'=>$offre->id_offre.'-'.strtolower(str_replace(str_split("'\\/:*?|+%."), '_', $offre->titre_offre))])}}">{{$offre->titre_offre}}</a>

                            @if($now->diff($offre->updated_at)->days<8)<span class="new">Nouveau</span>@endif

                            @if($offre->exp_offre==1)<span style="background-color:red">Clôturée</span> @endif</a></h2>

                          <ul>

                            <!--<li>Publié le 15 Septembre 2020</li>-->

                            <li><i class="homsys-icon homsys-pen"></i> {{$offre->type_offre}}</li>

                            <li><i class="homsys-icon homsys-maps-and-flags"></i> {{$offre->ville_offre}}</li>

                            <li><i class="homsys-icon homsys-calendar"></i> {{$offre->duree}}</li>

                          </ul>

                        </div>

                        <div class="homsys-job-userlist"> <a href="{{url('offres',['id'=>$offre->id_offre])}}" class="homsys-option-btn">Détail / Postuler</a> </div>

                        <div class="clearfix"></div>

                      </div>

                    </div>

                  </li>

                  @endforeach



                </ul>

              </div>

              <div class="homsys-pagination-blog">

                {{ $offres->appends(request()->except('offre'))->links()}}

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

   @stop

