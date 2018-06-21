jQuery(function ($) {
    "use strict";

    var SLZ = window.SLZ || {};

    /*=======================================
    =             MAIN FUNCTION             =
    =======================================*/
    SLZ.mainFunction = function () {
        $('.wrapper-journey').slick({
            infinite: false,
            slidesToShow: 6,
            slidesToScroll: 6,
            autoplay: false,
            speed: 700,
            dots: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1201,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5
                    }
                },
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                },
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        dots: true,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 381,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false,
                    }
                }
            ]
        });

        if ($('.gallery-block .container').width() > 600) {
            var height_grid_item = $('.gallery-block .container').width() / 3;
            $('.gallery-block .grid-item,.gallery-block .grid-item img, .gallery-image .bg').css('height', height_grid_item - 50);

            $('.gallery-block .grid').isotope({
                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-sizer',
                    gutter: '.gutter-sizer'
                },
            });
        }
        else if ($('.gallery-block .container').width() > 414) {
            var height_grid_item = $('.gallery-block .container').width() / 2;
            $('.gallery-block .grid-item,.gallery-block .grid-item img, .gallery-image .bg').css('height', height_grid_item + 30);
        }

        $('.fancybox').fancybox({
            helpers: {
                thumbs: {
                    width: 50,
                    height: 50
                }
            }
        });

        $('.fancybox-device').fancybox({
            helpers: {
                thumbs: {
                    width: 50,
                    height: 50
                }
            }
        });

        if ($(window).width() > 1023)
            $('.gallery-block .grid .grid-item .gallery-image').directionalHover();

        if (window.innerWidth < 769) {

            $('.timeline-custom-col.content-col').each(function (index, el) {
                var height_for_point = $(this).height() / 2;
                $(this).prev().css('top', height_for_point);
            });
            $('.timeline-block:last-child .timeline-point').css('height', $('.timeline-block:last-child .timeline-content').height() - 150);
        }
        else {
            $('.timeline-custom-col.content-col').each(function (index, el) {
                if ($(this).height() > 250) {

                    $(this).prev().css('top', '125px');
                }
            });
            $('.timeline-block:last-child .timeline-point').css('height', $('.timeline-block:last-child .content-col').height() - 100);
        }

        $('.gallery-image .fancybox').each(function (index, el) {
            var src = $(this).attr('href');
            $(this).parents('.gallery-image').find('.bg').css({
                'background': 'url(' + src + ') no-repeat center',
                'background-size': 'cover'
            });
            if ($(window).width() < 1024) {
                $(this).parents('.gallery-image').find('.fancybox').removeClass('dh-overlay').find('.icons').remove();
            }
        });

        $('.btn-book-tour').click(function () {
            /* Act on the event */
            var row = $(this).data('row');
            var column = $(this).data('column');
            var url = $(this).data('href');
            var hotel = $('select[name="rest_hotel"]').val() ? $('select[name="rest_hotel"]').val() : '';
            $('.pointer').removeClass('find-widget');
            $(this).addClass('find-widget');
            $.ajax({
                url: url,
                type: 'post',
                data: {row: row, column: column, hotel: hotel, _token: token},
                success: function (data) {
                    $('.book-tour').html(data)
                    $('.timeline-book-block').addClass('show-book-block');
                    $('.input-daterange').datepicker({
                        startDate: 0,
                        language: "ru",
                        format: 'yyyy-mm-dd',
                        todayHighlight: true,
                        timePicker: true,
                        todayBtn: 1,
                    });
                    grecaptcha.reset();
                }
            });
        });
    };

    /*======================================
    =            INIT FUNCTIONS            =
    ======================================*/

    $(document).ready(function () {
        SLZ.mainFunction();
    });

    /*=====  End of INIT FUNCTIONS  ======*/
});
$(document).on('change', '.child', function () {
    if ($(this).val() > 0) {
        var count = $(this).val();
        $('.child-age').html('');
        var select = '<div class="text-box-wrapper"><select name="child_age[]" class="custom-select child_age total-send" required> <option value="">0</option>';
        for (var i = 1; i <= 17; i++) {
            select += '<option value="' + i + '">' + i + '</option>';
        }
        select += '</select></div>';
        $('.child-content').fadeIn();
        for (var i = 0; i < count; i++) {
            $('.child-age').append(select)
        }
    } else {
        $('.child-content').fadeOut();
        $('.child-age').html('');
    }
});


$(document).on('change', '.total-send', function () {
    total_send();
});
$(document).on('keyup keypress blur change paste', '.promo-send', function () {
    total_send();
});

function total_send() {
    $.ajax({
        url: total_url,
        type: 'post',
        data: $('.tour-book').serialize(),
        success: function (total) {
            $('.total').html(total.change_price).find('input[type="hidden"]').val(total.original_price);
        }
    })
}


$(document).on('submit', '.tour-book', function (event) {
    event.preventDefault();
    var form = $('.tour-book');
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        success: function (data) {
            if (data.success) {
                toastr.success(data.message);
                $('.find-hotel-widget').remove();
                $('.pointer').removeClass('find-widget');
                $('#g-recaptcha-response').reset();
            } else {
                toastr.error(data);
                grecaptcha.reset();
            }
        },
        error:function () {
            location.reload();
        }
    })

});