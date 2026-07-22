<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="Les meilleures missions en freelance en Développement, Gestion de projets, AMOA, MOE, DBA ... au Maroc sont sur homsys.ma">
    <meta name="keywords" content="Freelance, emploi Freelance, offres d'emploi Freelance, offres Freelance, mission, missions, missions freelance, mission freelance Maroc, missions freelance Maroc, emploi Maroc, offres Rabat, offres casablanca">
    <meta http-equiv="Content-Language" content="fr">
    <meta name="Geography" content="Morocco">
    <meta name="country" content="Morocco">
    <meta name="Language" content="French">
    <meta name="Copyright" content="homsys.ma">
    <meta name="Author" content="homsys.ma">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}" />

    <title>HOMSYS : Faites le choix d'un partenaire fiable</title>
    @include('css_js')
</head>
<body>

@include('layouts.menu')


@yield('content')


<!--twitter-feed-end-->
<footer class="footer_sections" id="contact">
    <div class="container">
        <section class="main-section contact" id="contact">
            <div class="row">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="contact-info-box address clearfix">
                        <h3>Pour nous cantacter</h3>
                        <p align="justify">Pour toute demande d’information ou si vous souhaitez être contacté par nos services, veuillez remplir et valider ce formulaire. ou d'envoyer simplement votre message à <span> <a href="mailto:contact@homsys.ma">  contact@homsys.ma</a> </span> </p>
                    </div>

                </div>
                <div class="col-lg-6 wow fadeInUp delay-06s">
                    <form method="POST" action="{{ url('mails/contact') }}">
                    <div class="form">
                        @csrf
                        <p style="color:red;"> {{Session::get('captcha')}}</p>
                        <input class="input-text animated wow flipInY delay-02s" type="text" name="name" placeholder="Nom *" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" required>
                        <input class="input-text animated wow flipInY delay-04s" type="text" name="email" placeholder="Email *" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" required>
                        <p style="color:white;"> Votre Message *</p>
                        <textarea class="input-text text-area animated wow flipInY delay-06s" name="message" cols="0" rows="0" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;"></textarea>
                        <div class="
                        g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                        <input class="input-btn animated wow flipInY delay-04s" type="submit" value="ENVOYER">
                    </form>
                    </div>
                </div>
            </div>
            <!-- fin-->
        </section>
    </div>
    <div class="container">
        <div class="footer_bottom">
            <span>Copyright © 2016 | <a href="https://www.homsys.ma/">HOMSYS</a>
            </span>
            <div align="center">
                <a href="https://linkedin.com/company/homsys-maroc" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-linkedin"></i> Linkedin</a>
                <a href="https://www.facebook.com/Homsys-230140987182373/" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-facebook-official"></i> Facebook</a>
                <a href="https://twitter.com/HomsysMaroc" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-twitter"></i> Twitter</a>
            </div>


        </div>

        <!--
            All links in the footer should remain intact.
            Licenseing information is available at: http://bootstraptaste.com/license/
            You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Butterfly
        -->
    </div>

</footer>
<!--<a href="#" title="LinkedIn" class="btn btn-linkedin btn-lg"><i class="fa fa-linkedin fa-fw"></i> LinkedIn</a>
            <button type="button" class="btn btn-li"><i class="fab fa-linkedin-in pr-1"></i> Linkedin</button>
            <a href="#" id="share-li" class="sharer button"><i class="fa fa-3x fa-linkedin-square"></i></a>-->

<script type="text/javascript">
    $(document).ready(function(e) {
        $('#header_outer').scrollToFixed();
        $('.res-nav_click').click(function(){
            $('.main-nav').slideToggle();
            return false

        });

    });
</script>
<script>
    wow = new WOW(
            {
                animateClass: 'animated',
                offset:       100
            }
    );
    wow.init();
</script>
<script type="text/javascript">
    $(window).load(function(){

        $('a').bind('click',function(event){
            var $anchor = $(this);

            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 91
            }, 1500,'easeInOutExpo');
            /*
             if you don't want to use the easing effects:
             $('html, body').stop().animate({
             scrollTop: $($anchor.attr('href')).offset().top
             }, 1000);
             */
            event.preventDefault();
        });
    })
</script>



<script type="text/javascript">


    jQuery(document).ready(function($){
// services Isotope
        var container = $('#services-wrap');


        container.isotope({
            animationEngine : 'best-available',
            animationOptions: {
                duration: 200,
                queue: false
            },
            layoutMode: 'fitRows'
        });

        $('#filters a').click(function(){
            $('#filters a').removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            container.isotope({ filter: selector });
            setProjects();
            return false;
        });


        function splitColumns() {
            var winWidth = $(window).width(),
                    columnNumb = 1;


            if (winWidth > 1024) {
                columnNumb = 4;
            } else if (winWidth > 900) {
                columnNumb = 2;
            } else if (winWidth > 479) {
                columnNumb = 2;
            } else if (winWidth < 479) {
                columnNumb = 1;
            }

            return columnNumb;
        }

        function setColumns() {
            var winWidth = $(window).width(),
                    columnNumb = splitColumns(),
                    postWidth = Math.floor(winWidth / columnNumb);

            container.find('.services-item').each(function () {
                $(this).css( {
                    width : postWidth + 'px'
                });
            });
        }

        function setProjects() {
            setColumns();
            container.isotope('reLayout');
        }

        container.imagesLoaded(function () {
            setColumns();
        });


        $(window).bind('resize', function () {
            setProjects();
        });

    });
    $( window ).load(function() {
        jQuery('#all').click();
        return false;
    });
</script>
</body>
</html>
