<div class="homsys-banner homsys-typo-wrap"> <span class="homsys-banner-transparent"></span>

    <div class="homsys-banner-caption">

      <div class="container">

        <h1>Viser plus haut. Allez plus loin. Rêver plus grand</h1>

        <p> Une meilleure carrière est quelque part. Nous vous aiderons pour la décrocher</p>



        <form method="POST" action="/offres/search" class="homsys-banner-search">
          @csrf

          <ul>

            <li>

              <input type="text" name="keyword" placeholder="Intitulé, Mot clé, .." value="{{ isset($keyword) ? $keyword : '' }}">

            </li>

            <li>

              <input type="text" name="ville" placeholder="Ville" value="{{ isset($ville) ? $ville : '' }}">

              <i class="homsys-icon homsys-location"></i> </li>

            <li>

              <div class="homsys-select-style">

                 <select name="type">
                   <option value="">Type Contrat</option>
                   <option value="Freelance" {{ isset($type) && $type === 'Freelance' ? 'selected' : '' }}>Freelance</option>
                   <option value="CDI" {{ isset($type) && $type === 'CDI' ? 'selected' : '' }}>CDI</option>
                   <option value="CDD" {{ isset($type) && $type === 'CDD' ? 'selected' : '' }}>CDD</option>
                   <option value="Stage" {{ isset($type) && $type === 'Stage' ? 'selected' : '' }}>Stage</option>
                 </select>

              </div>

            </li>

            <li class="homsys-banner-submit">

              <input type="submit" value="">

              <i class="homsys-icon homsys-search"></i> </li>

          </ul>

        </form>

      </div>

    </div>

  </div>

