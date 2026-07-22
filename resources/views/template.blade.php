<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"  charset="UTF-8"/>
    <meta charset="utf-8" />

    <title>@yield('titre')</title>
    @include('css_js')
</head>
<body>

@include('navbar')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success">
        @if(is_array(session()->get('success')))
        <ul>
            @foreach (session()->get('success') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        @else
            {{ session()->get('success') }}
        @endif
    </div>
@endif
        <!--Top_content-->
<section id="top_content" class="top_cont_outer">
    <div class="top_cont_inner">
        <div class="container">
            <div class="top_content">
                <div class="row">
                    <div class="col-md-9">
                        <div class="top_left_cont fadeInLeft  wow animated">
                            @yield('main')

                        </div>
                    </div>




                    <div class="col-md-3">
                        <h3><i class="fa fa-clock-o" aria-hidden="true"></i>
                            Dernièrs offres</h3>
                        <ul class="list-group">
                           @if( empty($offres_news ))
                                <li class="list-group-item">Aucune offre</li>
                            @else
                            @foreach( $offres_news as $offre)
                            <li class="list-group-item"><a href="{{url('offres',['id'=>$offre->id_offre])}}"><i class="fa fa fa-square fa-spin" ></i>
                                    {{$offre->titre_offre}}</a>
                            <p><span class="mb-10 mr-10 font-13">Contrat : {{$offre->type_offre}}  <i class="fa fa-map-marker mr-5 text-theme-colored"></i> {{$offre->ville_offre}}</span></p>
                            </li>

                            @endforeach
                            @endif
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>
<br><br>
</section>
<!--Top_content-->

<!--Service-->
<div class="space_brief">
    <div class="col-md-6"></div>
    <div class="col-md-12"><br></div>
    <div class="col-md-12"><br></div><div class="col-md-12"><br></div><div class="col-md-12"><br></div>
</div>
<footer class="footer_section" id="contact" >

    <div class="container">
        <div class="footer_bottom">
            <span>Copyright © 2016 | <a href="https://www.homsys.ma/">HOMSYS</a>  </span>
            <div align="center">
                <a href="https://linkedin.com/company/homsys-maroc" target="_blank" class="btn btn-primary"><i class="fa fa-linkedin"></i> Linkedin</a>
                <a href="https://www.facebook.com/Homsys-230140987182373/" target="_blank" class="btn btn-primary"><i class="fa fa-facebook-official"></i> Facebook</a>
                <a href="https://twitter.com/HomsysMaroc" target="_blank" class="btn btn-primary"><i class="fa fa-twitter"></i> Twitter</a>
            </div>
         </div>

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
