jQuery(function($) {
    "use strict";

    var SLZ = window.SLZ || {};


    /*=======================================
    =             MAIN FUNCTION             =
    =======================================*/

    SLZ.mainFunction = function() {
        $('.wrapper-cd-detail').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.wrapper-cd-detail-thumnail'
        });
        $('.wrapper-cd-detail-thumnail').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.wrapper-cd-detail',
            focusOnSelect: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        autoplaySpeed: 5000,
                    }
                },
                {
                    breakpoint: 601,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrows: false,
                        autoplay: true,
                        autoplaySpeed: 5000,
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrows: false,
                        autoplay: true,
                        autoplaySpeed: 5000,
                    }
                }
            ]
        });
        $('.btn-book-tour').click(function(event) {
            /* Act on the event */
            event.preventDefault();
            $(this).parent().next('.timeline-book-block').toggleClass('show-book-block');
        });
    };

    /*======================================
    =            INIT FUNCTIONS            =
    ======================================*/

    $(document).ready(function() {
        SLZ.mainFunction();
    });

    /*======================================
    =          END INIT FUNCTIONS          =
    ======================================*/

});



$('.car_attribute').change(function () {
    car_total();
});
$('.send_total').on('changeDate',function () {
   car_total();
});

function car_total() {
    var array = [];

    $('.car_attribute').each(function () {
        if ($(this).is(':checked')){
            array.push($(this).val())
        }
    });
    var check_in = $('input[name="check_in"]').val();
    var check_out = $('input[name="check_out"]').val();
    $.ajax({
        url:url,
        type:'post',
        data:{attribute:array, check_in:check_in, check_ouy:check_out, _token:token},
        success:function (data) {
            if (data['error']) {
                toastr.error(data['message']);
            } else if (data['success']) {
                $('.hotel-total-container').fadeIn();
                $('.transport-total').find('input[data-name="origin_price"]').val(data['origin_price']);
                $('.transport-total').find('span').text(data['total']);

            }
        }
    })
}

$(document).on('submit','.transport-book', function (form) {
   form.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        success:function (data) {
            if (data.success ){
                $('.transport-book').trigger( 'reset' );
                $('.timeline-book-block').toggleClass('show-book-block');
                toastr.success(data.message);
                grecaptcha.reset();
            }else{
                toastr.error(data);
                grecaptcha.reset();
            }
        },
        error:function () {
            // location.reload();
        }
    })
});





