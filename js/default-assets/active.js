let wow = null;

(function ($) {
    'use strict';

    var page_window = $(window);

    // ****************************
    // :: 1.0 Preloader Active Code
    // ****************************

    page_window.on('load', function () {
        $('#preloader').fadeOut('1000', function () {
            $(this).remove();
        });
    });

    // ****************************
    // :: 2.0 ClassyNav Active Code
    // ****************************

    if ($.fn.classyNav) {
        $('#alimeNav').classyNav();
    }

    // *********************************
    // :: 5.0 Masonary Gallery Active Code
    // *********************************

    if ($.fn.imagesLoaded) {
        $('.alime-portfolio').imagesLoaded(function () {
            // filter items on button click
            $('.portfolio-menu').on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });
            // init Isotope
            var $grid = $('.alime-portfolio').isotope({
                itemSelector: '.single_gallery_item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.single_gallery_item'
                }
            });
        });
    }

    // ***********************************
    // :: 6.0 Portfolio Button Active Code
    // ***********************************
    
    $('.portfolio-menu button.btn').on('click', function (event) {
        $('.portfolio-menu button.btn').removeClass('active');
        $(this).addClass('active');

        $(".single_gallery_item").css("visibility","visible");
        // $(".single_gallery_item").css("animation-name","none");
        // $(".single_gallery_item").css("animation-delay","inherit");
        $(".single_gallery_item").css("animation","none");

        // $(".single_gallery_item").removeClass("wow");
        // $(".single_gallery_item").removeClass("fadeInUp");
        // $(".single_gallery_item").removeAttr("data-wow-delay");

        // wow.all = [];
    });


    // ************************
    // :: 8.0 Stick Active Code
    // ************************

    page_window.on('scroll load', function () {
        if (page_window.scrollTop() > 0) {
            $('.main-header-area').addClass('sticky');
        } else {
            $('.main-header-area').removeClass('sticky');
        }
    });

    // *********************************
    // :: 9.0 Magnific Popup Active Code
    // *********************************
    if ($.fn.magnificPopup) {
        $('.video-play-btn').magnificPopup({
            type: 'iframe'
        });
        $('.portfolio-img').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true,
                preload: [0, 2],
                navigateByImgClick: true,
                tPrev: 'Previous',
                tNext: 'Next'
            }
        });
    }

    // Small Logo appearance
    page_window.on('scroll load', function () {
        let menu_logo_hidden = $('#menu-logo').hasClass('hidden');

        let logo_visible = checkVisibleWithOffset("welcome-text", "header-area");
        let logo_visible_full = checkVisibleFullWithOffset("welcome-text", "header-area", "main-logo");

        if (!logo_visible && menu_logo_hidden) {
            $('#menu-logo').removeClass('hidden');
        } else if (!menu_logo_hidden && logo_visible_full) {
            $('#menu-logo').addClass('hidden');
        }

        /*
        if ((logo_visible && menu_logo_hidden) || ()) {
            $('#menu-logo').addClass('hidden');
        } else {
            $('#menu-logo').removeClass('hidden');
        }*/
    });

    // ***********************
    // :: 11.0 WOW Active Code
    // ***********************
    if (page_window.width() > 767) {
        wow = new WOW();
        wow.init();
    }

    // ****************************
    // :: 12.0 Jarallax Active Code
    // ****************************
    /*
    if ($.fn.jarallax) {
        $('.jarallax').jarallax({
            speed: 0.5
        });
    }
     */

    // ****************************
    // :: 13.0 Scrollup Active Code
    // ****************************
    /*
    if ($.fn.scrollUp) {
        page_window.scrollUp({
            scrollSpeed: 1000,
            scrollText: '<i class="arrow_carrot-up"</i>'
        });
    }
     */

    // *********************************
    // :: 14.0 Prevent Default 'a' Click
    // *********************************
    $('a[href="#"]').on('click', function ($) {
        $.preventDefault();
    });


    $('#link-uvod').on('click', function (event) {
        scrollToAnchor(event, 'anchor-uvod', false);
    });

    $('#link-o-kapele').on('click', function (event) {
        scrollToAnchor(event, 'anchor-o-kapele');
    });

    $('#link-koncerty').on('click', function (event) {
        scrollToAnchor(event, 'anchor-koncerty');
    });

    $('#link-pro-poradatele').on('click', function (event) {
        scrollToAnchor(event, 'anchor-pro-poradatele');
    });

    $('#link-kontakt').on('click', function (event) {
        scrollToAnchor(event, 'anchor-kontakt');
    });

    $('#link-galerie').on('click', function (event) {
        scrollToAnchor(event, 'anchor-galerie');
    });

    page_window.on("scroll load", function () {
        let anchors = ["anchor-uvod", "anchor-o-kapele", "anchor-koncerty", "anchor-pro-poradatele", "anchor-kontakt", "anchor-galerie"];

        let offsetRect = document.getElementById("header-area").getBoundingClientRect().height;

        for (let i = anchors.length - 1; i >= 0; i--) {
            let anchor_position = document.getElementById(anchors[i]).getBoundingClientRect();
            let is_valid = 0 > anchor_position.top - offsetRect - 1;

            if (is_valid) {
                $("#nav").children("li").each(function () {
                    $(this).removeClass("active");
                });

                $($("#nav").children("li")[i]).addClass("active");

                break;
            }
        }
    });


    let urlParams = new URLSearchParams(window.location.search);
    let email_successful = urlParams.get('email_successful');

    if (email_successful !== null) {
        if (email_successful === "true") {
            alert("Váše zpráva byla úspěšně odeslána!");
        } else {
            alert("Během odesílání zprávy došlo k chybě. Využijte prosím email nebo telefon uvedený v kontaktech.");
        }
    }

})(jQuery);

function scrollToAnchor(event, scroll_to_id, is_offset = true){
    event.preventDefault();

    let offsetRect = document.getElementById("header-area").getBoundingClientRect().height;

    $('html,body').animate({scrollTop: $("#" + scroll_to_id).offset().top - (is_offset ? offsetRect : 0)},'slow');
}

function checkVisible(elm) {
    let rect = elm.getBoundingClientRect();
    let viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
    return rect.bottom >= 0 && rect.top + viewHeight < 0;
}

function checkVisibleWithOffset(elm, offsetElm) {
    let rect = document.getElementById(elm).getBoundingClientRect();
    let offsetRect = document.getElementById(offsetElm).getBoundingClientRect();
    let viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
    return !(rect.bottom - offsetRect.bottom < 0 || rect.top - offsetRect.top - viewHeight >= 0);
}

function checkVisibleFullWithOffset(elm, offsetElm, checkedEl) {
    let rect = document.getElementById(elm).getBoundingClientRect();
    let offsetRect = document.getElementById(offsetElm).getBoundingClientRect();
    let viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);

    let elHeight = $('#'+checkedEl).height();
    return !(rect.bottom - (offsetRect.bottom + elHeight) < 0 || rect.top - offsetRect.top - viewHeight >= 0);
}