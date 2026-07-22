<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <title>HOMSYS : Faites le choix d'un partenaire fiable</title>
    @include('css_js')
</head>
<body>

@include('navbar')

<section id="top_content" class="top_cont_outer">
    <div class="top_cont_inner">
        <div class="container">
            <div class="top_content">
                <div class="row" >
                    <div class="col-lg-5 col-sm-7">
                        <div class="top_left_cont flipInY wow animated" >
                            <h3><i class="fa fa-archive" aria-hidden="true"></i> | Bienvenue à l'espace administration</h3>


                            <h2>Login</h2>

                            <form role="form" method="POST" action="{{ url('/admin/login') }}">

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <p>emaaaail<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                    </p>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <p>password<input id="password" type="password" class="form-control" name="password" >
                                    </p>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </form>




                            <br>



                        </div>
                    </div>





                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
</section>
<!--twitter-feed-end-->
<footer class="footer_section" id="contact" >

    <div class="container">

        <div class="footer_bottom"> <span>Copyright © 2016 | <a href="https://www.homsys.ma/">HOMSYS</a>  </span> </div>
        <!--
        All links in the footer should remain intact.
        Licenseing information is available at: http://bootstraptaste.com/license/
        You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Butterfly
    -->
    </div>
</footer>

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

<!--<script type="text/javascript">

$(window).load(function(){


  var $container = $('.servicesContainer'),
      $body = $('body'),
      colW = 350,
      columns = null;


  $container.isotope({
    // disable window resizing
    resizable: true,
    masonry: {
      columnWidth: colW
    }
  });

  $(window).smartresize(function(){
    // check if columns has changed
    var currentColumns = Math.floor( ( $body.width() -30 ) / colW );
    if ( currentColumns !== columns ) {
      // set new column count
      columns = currentColumns;
      // apply width to container manually, then trigger relayout
      $container.width( columns * colW )
        .isotope('reLayout');
    }

  }).smartresize(); // trigger resize to set container width
  $('.servicesFilter a').click(function(){
        $('.servicesFilter .current').removeClass('current');
        $(this).addClass('current');

        var selector = $(this).attr('data-filter');
        $container.isotope({

            filter: selector,
         });
         return false;
    });

});

</script>


-->

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