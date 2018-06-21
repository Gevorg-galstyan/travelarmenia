jQuery(function ($) {
    "use strict";

    var SLZ = window.SLZ || {};


    /*=======================================
    =            SAMPLE FUNCTION            =
    =======================================*/
    $(window).on('resize load', function (event) {
        //Responsive slider for Tab search default
        if ($(window).width() <= 480) {
            if (!$('.tab-search-default .nav-tabs').hasClass('slick-slider')) {
                $('.tab-search-default .nav-tabs').slick({
                    fade: true,
                    mobileFirst: true,
                    swipe: false,
                    responsive: [{
                        breakpoint: 480,
                        settings: "unslick"
                    }]
                });
                $('.tab-search-default .slick-prev, .tab-search-default .slick-next').on('click', function (event) {
                    console.log($('.tab-search-default .nav-tabs li.slick-current a').attr('href'));
                    $('.tab-search-default .nav-tabs li.slick-current a').tab('show');
                });
            }
            $('.tab-search-condensed .nav-tabs, .tab-search-transparent .nav-tabs').each(function () {
                var height = $(this).height();
                $(this).css('margin-bottom', height * (-1));
            });
        } else {
            $('.tab-search-condensed .nav-tabs, .tab-search-transparent .nav-tabs').removeAttr('style');
        }
    });
    $('.single-item').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    infinite: true,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }

            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('.hotels-list').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    infinite: true,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }

            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    // slide section NEWS AND UPDATES
    $('.news-lists').slick({
        infinite: true,
        dots: true,
        speed: 700,
        slidesToShow: 1,
        slidesToScroll: 1,
        // fade: true,
        cssEase: 'linear',
        arrows: false

    });
    SLZ.mainFunction = function () {
        // banner homepage default
        var width_boder = $('.homepage-default .title').width() - $('.homepage-default .text').width() - 10;
        $('.homepage-default .text .boder').width(width_boder);

        // slide section AWESOME TOURS
        $('.tours-list').slick({
            infinite: true,
            speed: 1000,
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            responsive: [{
                breakpoint: 769,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: true
                }
            }, {
                breakpoint: 601,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    speed: 600
                }
            }, {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    speed: 600
                }
            }]
        });

        // Slide section HAPPY TRAVELER
        // $('.traveler-list').slick({
        //     infinite: true,
        //     slidesToShow: 2,
        //     slidesToScroll: 1,
        //     autoplay: false,
        //     speed: 700,
        //     responsive: [{
        //         breakpoint: 769,
        //         settings: {
        //             slidesToShow: 2,
        //             slidesToScroll: 2,
        //             dots: true,
        //             arrows: false
        //         }
        //     }, {
        //         breakpoint: 601,
        //         settings: {
        //             slidesToShow: 1,
        //             slidesToScroll: 1,
        //             dots: true,
        //             arrows: false
        //         }
        //     }]
        // });

        ////Responsive for Tab search


        // JS for section Videos bg
        // var gurl = $(".video-embed")[0].src;
        // $(".video-button-play ").on('click', function (event) {
        //     $(".video-embed").addClass('show-video');
        //     $(".video-button-close").addClass('show-video');
        //     $(".video-embed")[0].src += "&autoplay=1";
        //     event.preventDefault();
        // });
        //
        // $(".video-button-close").on('click', function (event) {
        //     $(".video-embed")[0].src = gurl;
        //     $(".video-embed").removeClass('show-video');
        //     $(".video-button-close").removeClass('show-video');
        //
        //     //$(".video-embed")[0].removeAttribute("&autoplay=1");
        // });

        //JS for background home 4
        if ($(window).width() > 767) {
            $(".btn-play").on('click', function (event) {
                $(".bg-image").addClass('show-video');
                $(".btn-pause").removeClass('show-video');
                $(".btn-play").addClass('show-video');
            });

            $(".btn-pause").on('click', function (event) {
                $(".bg-image").removeClass('show-video');
                $(".btn-pause").addClass('show-video');
                $(".btn-play").removeClass('show-video');
            });
        }

        //parallax banner sale 2
        if ($('.banner-sale-2').length) {
            $('.banner-sale-2').mousemove(function (e) {
                $('.banner-sale-2 .text-parallax').parallax(25, e);
                // $( '.background' ).parallax( -30, e );
            });
        }

        if ($(".input-daterange").length || $(".date .tb-input").length) {
            // DATE PICKER
            $('.input-daterange, .date .tb-input').datepicker({
                format: 'yyyy-mm-dd',
                maxViewMode: 0,
                autoclose: true
            });
        }

    };

    /*=====  End of SAMPLE FUNCTION  ======*/


    /*======================================
    =            INIT FUNCTIONS            =
    ======================================*/

    $(document).ready(function () {
        SLZ.mainFunction();
    });

    /*=====  End of INIT FUNCTIONS  ======*/

    $('.country_select').change(function () {
        var country = $(this).val();
        $.ajax({
            url: $(this).data('url'),
            type: 'post',
            dataType: 'json',
            data: {country: country, _token: token},
            success: function (data) {
                if (data['success']) {
                    var html = '';
                    if (data['cities'].length > 0) {
                        $(data['cities']).each(function (i) {
                            html += '<option value="' + data['cities'][i]['link'] + '">' + data['cities'][i]['name'] + '</option>'
                        });
                    }
                    $('.city_select').html(html);

                    var action = $('.find_hotel').attr('action');
                    var array = action.split('/');
                    array[array.length - 1] = data['country'];
                    action = array.join('/');
                    $('.find_hotel').attr('action', action);

                }
            }
        })
    });

    $('.country_select_tour').change(function () {
        var country = $(this).val();
        var action = $('.find_tour').attr('action');
        var array = action.split('/');
        array[array.length - 1] = country;
        action = array.join('/');
        $('.find_tour').attr('action', action);
    });
});
