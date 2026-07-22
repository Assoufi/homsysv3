jQuery(document).ready(function($){'use strict';jQuery('.word-counter').countUp({delay:190,time:3000,});jQuery(".fancybox").fancybox({openEffect:'elastic',closeEffect:'elastic',});jQuery('.grid').isotope({itemSelector:'.grid-item',percentPosition:true,masonry:{fitWidth:false},});jQuery('.jobsearch_progressbar1').progressBar({percentage:false,backgroundColor:"#dbdbdb",barColor:"#13b5ea",animation:true,height:"6",});jQuery('.homsys_progressbar_two').progressBar({percentage:true,backgroundColor:"#e4e8e9",barColor:"#00b3eb",animation:true,height:"40",});jQuery('.homsys_progressbar_three').progressBar({percentage:true,backgroundColor:"#e4e8e9",barColor:"#ef5b48",animation:true,height:"40",});jQuery('.homsys_progressbar_four').progressBar({percentage:true,backgroundColor:"#e4e8e9",barColor:"#49bc7a",animation:true,height:"40",});jQuery('.homsys_progressbar_five').progressBar({percentage:true,backgroundColor:"#e4e8e9",barColor:"#edc26a",animation:true,height:"40",});jQuery('.homsys_progressbar_six').progressBar({percentage:true,backgroundColor:"#e4e8e9",barColor:"#00b3eb",animation:true,height:"24",});jQuery('.homsys_progressbar_seven').progressBar({percentage:true,backgroundColor:"#e4e8e9",barColor:"#ef5b48",animation:true,height:"24",});jQuery('.homsys_progressbar_eight').progressBar({percentage:true,backgroundColor:"#e4e8e9",barColor:"#49bc7a",animation:true,height:"24",});jQuery('.homsys_progressbar_nine').progressBar({percentage:true,backgroundColor:"#e4e8e9",barColor:"#edc26a",animation:true,height:"24",});});jQuery(".homsys-click-btn").on('click',function(e){jQuery(this).parents('.homsys-search-filter-toggle').find('.homsys-checkbox-toggle').slideToggle("slow",function(){});jQuery(this).parents('.homsys-search-filter-toggle').toggleClass("homsys-remove-padding",function(){});return false;});jQuery(".homsys-resume-addbtn").on('click',function(e){jQuery(this).parents('.homsys-candidate-resume-wrap').find('.homsys-add-popup').slideToggle("slow",function(){});return false;});function jobsearch_modal_popup_open(target){jQuery('#'+target).removeClass('fade').addClass('fade-in');jQuery('body').addClass('homsys-modal-active');}

jQuery(document).on('click','.homsys-modal .modal-close',function(){jQuery('.homsys-modal').removeClass('fade-in').addClass('fade');jQuery('body').removeClass('homsys-modal-active');});jQuery('.modal-content-area').on('click',function(e){if(e.target!==e.currentTarget)return;jQuery('.homsys-modal').removeClass('fade-in').addClass('fade');jQuery('body').removeClass('homsys-modal-active');});jQuery(document).on('click','.homsys-open-signin-tab',function(){jobsearch_modal_popup_open('JobSearchModalLogin');});jQuery(document).on('click','.homsys-open-signup-tab',function(){jobsearch_modal_popup_open('JobSearchModalSignup');});if(jQuery('#homsys-uploadbtn').length>0){document.getElementById("homsys-uploadbtn").onchange=function(){document.getElementById("homsys-uploadfile").value=this.value;};}

// Menu mobile toggle
$(document).ready(function() {
    // Créer le bouton burger s'il n'existe pas
    if ($('.mobile-menu-toggle').length === 0) {
        $('.homsys-right').prepend('<button class="mobile-menu-toggle" aria-label="Menu"><i class="fa fa-bars"></i></button>');
    }
    
    // Toggle menu sur mobile
    $('.mobile-menu-toggle').on('click', function() {
        $('.navbar-nav').toggleClass('responsive');
        $('body').toggleClass('menu-open');
    });
    
    // Gestion des sous-menus en mobile
    $('.navbar-nav .sub-menu').parent().children('a').on('click', function(e) {
        if ($(window).width() <= 991) {
            e.preventDefault();
            $(this).siblings('.sub-menu').toggleClass('active');
            $(this).find('i').toggleClass('fa-angle-double-down fa-angle-double-up');
        }
    });
    
    // Fermer le menu en cliquant à l'extérieur
    $(document).on('click', function(e) {
        if ($(window).width() <= 991) {
            if (!$(e.target).closest('.homsys-right').length) {
                $('.navbar-nav').removeClass('responsive');
                $('body').removeClass('menu-open');
            }
        }
    });
    
    // Réinitialiser sur resize
    $(window).on('resize', function() {
        if ($(window).width() > 991) {
            $('.navbar-nav').removeClass('responsive');
            $('.sub-menu').removeClass('active');
        }
    });
});