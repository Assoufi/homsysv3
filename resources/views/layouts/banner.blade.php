<div class="homsys-banner homsys-typo-wrap"> <span class="homsys-banner-transparent"></span>

    <div class="homsys-banner-caption">

      <div class="container">

        <h1>Viser plus haut. Allez plus loin. Rêver plus grand</h1>

        <p> Une meilleure carrière est quelque part. Nous vous aiderons pour la décrocher</p>



        <form method="GET" action="{{ url('offres/search') }}" class="homsys-banner-search">

          <ul>

            <li>

              <input type="text" name="keyword" placeholder="Intitulé, compétences, poste..." value="{{ request('keyword', '') }}">

            </li>

            <li>

              <input type="text" name="ville" placeholder="Ville" value="{{ request('ville', '') }}" list="banner-villes">
              <datalist id="banner-villes">
                @isset($villes)
                  @foreach($villes as $v)
                    <option value="{{ $v }}">
                  @endforeach
                @endisset
              </datalist>

            </li>

            <li>

              <div class="homsys-select-style">

                 <select name="type">
                   <option value="">Tous les types</option>
                   <option value="Freelance" {{ request('type') === 'Freelance' ? 'selected' : '' }}>Freelance</option>
                   <option value="CDI" {{ request('type') === 'CDI' ? 'selected' : '' }}>CDI</option>
                   <option value="CDD" {{ request('type') === 'CDD' ? 'selected' : '' }}>CDD</option>
                   <option value="Stage" {{ request('type') === 'Stage' ? 'selected' : '' }}>Stage</option>
                 </select>

              </div>

            </li>

            <li class="homsys-banner-submit">

              <button type="submit" class="homsys-banner-search-btn">
                <i class="fa fa-search"></i> Rechercher
              </button>

            </li>

          </ul>

        </form>

      </div>

    </div>

  </div>

