@extends('layouts.front2')

@section('titre')
    {!! $meta['title'] !!}
@stop

@section('content')
  <div class="homsys-main-content">
    <br><br><br><br>
    <div class="homsys-main-section homsys-contact-form-full-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="homsys-contact-info-sec">
              <h2>Informations de Contact </h2>
              <p> N`hésitez pas à nous contacter pour tout renseignement concernant nos services</p>
              <ul class="homsys-contact-info-list">
                <li><i class="homsys-icon homsys-placeholder"></i> Adresse :  2, Angle Bd Youssef Ibn Tachafine et rue Zineb Ishak, N° 07 - Casablanca </li>
                <li><i class="homsys-icon homsys-mail"></i> <a href="#">Email: <span class="__cf_email__">contact@homsys.ma</span></a></li>
                <!--<li><i class="homsys-icon homsys-technology"></i> Téléphone : 05 22 00 00 00 00</li>-->
              </ul>
              <div class="homsys-contact-media"><a href="https://www.linkedin.com/company/homsys-maroc/" target="_blank" class="homsys-icon homsys-linkedin-button"></a> <a href="https://www.facebook.com/Homsys-230140987182373/" target="_blank" class="homsys-icon homsys-facebook-logo"></a> <a target="_blank" href="https://twitter.com/HomsysMaroc" class="homsys-icon homsys-twitter-logo"></a> </div>

              <div ><iframe width="200" height="200" src="https://maps.google.com/maps?hl=en&amp;q=2 rue zineb ishak casablanca+()&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
              </div>
            </div>

            <div class="homsys-contact-form">
              <h2>Nous voulons vous entendre!</h2>
              <form action="{{ url('mails/contact') }}" method="post">
                @csrf
                <ul>
                  <li>
                    <input name="name" value="Votre Nom" onBlur="if(this.value == '') { this.value ='Votre Nom'; }" onFocus="if(this.value =='Votre Nom') { this.value = ''; }" type="text">
                    <i class="homsys-icon homsys-user"></i></li>
                  <li>
                    <input name="email" value="Votre Email" onBlur="if(this.value == '') { this.value ='Votre Email'; }" onFocus="if(this.value =='Votre Email') { this.value = ''; }" type="text">
                    <i class="homsys-icon homsys-mail"></i></li>
                  <li>
                    <input name="sujet" value="Sujet" onBlur="if(this.value == '') { this.value ='Sujet'; }" onFocus="if(this.value =='Sujet') { this.value = ''; }" type="text">
                    <i class="homsys-icon homsys-user"></i></li>
                  <li>
                    <input name="tel" value="Votre numéro de téléphone" onBlur="if(this.value == '') { this.value ='Votre numéro de téléphone'; }" onFocus="if(this.value =='Votre numéro de téléphone') { this.value = ''; }" type="text">
                    <i class="homsys-icon homsys-technology"></i></li>
                  <li class="homsys-contact-form-full">
                    <textarea id="texto" name="message" placeholder="Votre message..."></textarea>
                  </li>
                  <!--<li>
                    <div class="g-recaptcha" data-sitekey="{!! env('NOCAPTCHA_SITEKEY') !!}"></div>
                  </li>
                -->
                  <li>
                    <input type="submit" value="Envoyer">
                  </li>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop