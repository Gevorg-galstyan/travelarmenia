var token = $('meta[name="token"]').attr('content');


$(window).on('resize load', function (event) {
    $('.nstSlider').nstSlider({
        "crossable_handles": false,
        "left_grip_selector": ".leftGrip",
        "right_grip_selector": ".rightGrip",
        "value_changed_callback": function (cause, leftValue, rightValue) {
            var lft = $(this).find('.leftGrip .number');
            var rht = $(this).find('.rightGrip .number');
            lft.text(leftValue);
            rht.text(rightValue);
            var leftGripBoderRight = lft.offset().left + lft.width();
            var rightGripBorderLeft = rht.offset().left;
            if (leftGripBoderRight >= rightGripBorderLeft) {
                rht.css("top", "20px");
            } else {
                rht.removeAttr("style");
            }
            if (leftGripBoderRight <= $(".leftLabel").offset().left + 30) {
                $(".leftLabel").css("top", "20px");
            } else {
                $(".leftLabel").removeAttr("style");
            }
            if (rightGripBorderLeft >= $(".rightLabel").offset().left - 30) {
                $(".rightLabel").css("top", "20px");
            } else {
                $(".rightLabel").removeAttr("style");
            }
        },
        'user_mouseup_callback': function (vmin, vmax, left_grip_moved) {
            window.location.href = filter_url + '?price_min=' + vmin + '&price_max=' + vmax;
        }
    });
});

$('.slider-for').each(function (key, item) {

    var sliderIdName = 'slider' + key;
    var sliderNavIdName = 'sliderNav' + key;

    this.id = sliderIdName;
    $('.slider-nav')[key].id = sliderNavIdName;

    var sliderId = '#' + sliderIdName;
    var sliderNavId = '#' + sliderNavIdName;

    $(sliderId).slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: sliderNavId
    });

    $(sliderNavId).slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: sliderId,
        arrows: false,
        infinite: true,
        // centerMode: true,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 381,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
        ]
    });

});


$('.adult,.child').change(function () {
    change_input(this);
});

$('.promo_code').bind('input paste change keyup', function () {
    change_input(this)
});


function change_input(input) {
    var adult = $('.adult').val();
    var child = $('.child').val();
    var promo = $('.promo_code').val();
    var test = parseInt(parseInt(adult) + parseInt(child));
    if (test > available) {
        $(input).val(0);
        alert('warning');
    } else {
        if (adult) {
            var url = $('.book-now').attr('action');
            $.ajax({
                url: url,
                type: 'post',
                data: {adult: adult, child: child, promo_code: promo, change_value: true, _token: token},
                success: function (data) {
                    if (data) {
                        $('.total').fadeIn();
                        $('span.total').html(data);
                    }
                }
            })
        }
    }
}


$('.book-hotel').click(function (data) {
    data.preventDefault();
    var data = $(this).data('target');
    $(".timeline-book-block[data-status!='" + data + "']").removeClass('show-book-block');
    $('[data-status="' + data + '"').toggleClass('show-book-block');
});


$('.rest_hotel').change(function () {
    var rest_url = $('.rest_hotel option:selected').data('href');
    $(".see").attr('href', rest_url);
});

// Add slideDown animation to Bootstrap dropdown when expanding.
$('.dropdown').on('dropdown', function () {
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
});

// Add slideUp animation to Bootstrap dropdown when collapsing.
$('.dropdown').on('dropdown', function () {
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
});

$('.change-currency').click(function (event) {
    event.preventDefault();
    to_currency = $(this).data('currency');
    change_currency(to_currency);
});

$(document).on('change', 'select[name="change_currency"]', function () {
    to_currency = $(this).val();
    change_currency(to_currency);
})

function change_currency(to_currency) {
    $.ajax({
        url: '/change-currency',
        type: 'post',
        data: {from_currency: active_currency, to_currency: to_currency, _token: token},
        success: function (data) {
            if (data['success']) {
                $('[data-name="price"]').each(function () {
                    var origin_value = $(this).find('input[data-name="origin_price"]').val();
                    $(this).find('span').text(parseInt(origin_value / data['value']))
                });
                $('.valuta_sinvol').text(data.sinvol);
                $('.currency-active').removeClass('currency-active');
                $('#' + to_currency).addClass('currency-active');
                $('#currency').text(to_currency).css('text-transform', 'uppercase');
                $('select[name="change_currency"]').find('option[data-name="' + data.marak + '"]').prop('selected', true)
            }
            active_currency = to_currency;
        },
        error: function () {
            location.href = 'not-found';
        }
    });
}


(function ($) {
    $(document).ready(function () {
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
            // event.preventDefault();
            event.stopPropagation();
            $(this).parent().siblings().removeClass('open');
            $(this).parent().toggleClass('open');
        });
    });
})(jQuery);

$('.subscriber-form').submit(function (form) {
    form.preventDefault();
    input = $(this).find('input[name="email"]');
    if ($(input).val()) {
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            // dataType:'json',
            data: $(this).serialize(),
            error: function (response) {
                // location.reload();
            },
            success: function (data) {
                if (data['success']) {
                    $(input).val('');
                    toastr.success(data['message']);
                } else {
                    toastr.error(data);
                }

            }
        });
    }
});

$('.country').change(function () {
    var country = $(this).val();
    var form = $('form[data-status="' + $(this).data('target') + '"]');
    var url = $(form).attr('action');
    var arr_url = url.split('/');
    if (arr_url[3] == 'en') {
        arr_url[5] = country;
    } else if (arr_url[3] == 'ru') {
        arr_url[5] = country;
    } else {
        arr_url[4] = country;
    }
    url = arr_url.join('/');
    $(form).attr('action', url);
});

$('.hotel-country').change(function () {
    var country = $(this).val();
    $('.hotel-city option').css('display', 'none');
    $('.city-' + country).css('display', 'block').first().prop('selected', true);
});


