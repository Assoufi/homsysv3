<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{ URL::asset('favicon.png') }}" type="image/png">

<!-- Bootstrap CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">

<!-- Custom CSS -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/style2.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/flaticon.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/slick-slider.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/fancybox.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/plugin.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/color.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/linecons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/modern-custom.css') }}" rel="stylesheet" type="text/css">

<!-- Animation CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" type="text/css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Lato:400,900,700,700italic,400italic,300italic,300,100italic,100,900italic" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Dosis:400,500,700,800,600,300,200" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic-ext,vietnamese" rel="stylesheet">

<!-- Bootstrap DatePicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- Trix Editor CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">

<!-- Bootstrap Toggle CSS -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<!-- Bootstrap FileInput CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<!-- Menu Fix CSS -->
<link href="{{ asset('css/menu-fix.css') }}" rel="stylesheet" type="text/css">

<!-- Livewire Styles -->
@livewireStyles

<!-- Menu JS -->
<script src="{{ asset('script/menu.js') }}"></script>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.min.js"></script>

<!-- jQuery Plugins -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrolltofixed/1.0.8/jquery-scrolltofixed-min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Isotope JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/isotope/3.0.6/isotope.pkgd.min.js"></script>

<!-- WOW JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>

<!-- Classie JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/classie/1.0.1/classie.min.js"></script>

<!-- PDF Object JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.12/pdfobject.min.js"></script>

<!-- Local Custom Scripts -->
<script src="{{ asset('script/bootstrap.js') }}"></script>
<script src="{{ asset('script/slick-slider.js') }}"></script>
<script src="{{ asset('script/counter.js') }}"></script>
<script src="{{ asset('script/function.js') }}"></script>
<script src="{{ asset('script/progressbar.js') }}"></script>
<script src="{{ asset('script/progress-circle.js') }}"></script>
<script src="{{ asset('script/jquery.countdown.js') }}"></script>
<script src="{{ asset('script/fancybox.pack.js') }}"></script>
<script src="{{ asset('script/isotope.min.js') }}"></script>

<!-- Bootstrap DatePicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.fr.min.js"></script>

<!-- Trix Editor JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>

<!-- Bootstrap Toggle JS -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- TinyMCE JS -->
<script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    if (typeof tinymce !== 'undefined') {
        tinymce.init({ menubar: false, statusbar: false, selector: 'textarea.tinymce' });
    }
</script>

<!-- Bootstrap FileInput JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/js/plugins/purify.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/themes/fa/theme.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/js/locales/fr.min.js"></script>

<!-- HighCharts JS -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-50260880-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-50260880-1');
</script>

<!-- ShareThis -->
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f385ac245c7af00120495b2&product=sop' async='async'></script>

<!-- Livewire Scripts -->
@livewireScripts

<!-- IE Compatibility -->
<!--[if lt IE 9]>
    <script src="{{ asset('js/respond-1.1.0.min.js') }}"></script>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <script src="{{ asset('js/html5element.js') }}"></script>
<![endif]-->

<!-- Common Scripts -->
<script type="text/javascript">
    $(document).ready(function () {
        // Responsive navigation
        $('.res-nav_click').click(function () {
            $('ul.toggle').slideToggle(600);
        });

        // Fixed header on scroll
        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > 0) {
                $('#header_outer').addClass('fixed');
            } else {
                $('#header_outer').removeClass('fixed');
            }
        });

        // Tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });

    function resizeText() {
        var preferredWidth = 767;
        var displayWidth = window.innerWidth;
        var percentage = displayWidth / preferredWidth;
        var fontsizetitle = 25;
        var newFontSizeTitle = Math.floor(fontsizetitle * percentage);
        $(".divclass").css("font-size", newFontSizeTitle);
    }

    // Session timeout
    var timeout = ({{config('session.lifetime')}} * 60) * 1000;
    setTimeout(function() {
        window.location = '';
    }, timeout);

    function htmlDecode(value) {
        return $("<div/>").html(value).text();
    }
</script>
