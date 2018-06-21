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


        $('.btn-book-tour').click(function (event) {
            /* Act on the event */
            event.preventDefault();
            $(this).parents('.timeline-content').find('.timeline-book-block').toggleClass('show-book-block');
        });


        /*Google map*/

        var myLatLng = center;
        var markerLatLng = center;
        var customMapType = new google.maps.StyledMapType(
            [
                {
                    "featureType": "water",
                    "stylers": [
                        {"color": "#f0f3f6"}
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [
                        {"color": "#adb3b7"}
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.icon",
                    "stylers": [
                        {"hue": "#ededed"}
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "stylers": [
                        {"color": "#c8cccf"}
                    ]
                },
                {
                    "featureType": "road.local",
                    "stylers": [
                        {"color": "#e6e6e6"}
                    ]
                },
                {
                    "featureType": "landscape",
                    "stylers": [
                        {"color": "#ffffff"}
                    ]
                },
                {
                    "elementType": "labels.text",
                    "stylers": [
                        {"weight": 0.1},
                        {"color": "#6d6d71"}
                    ]
                }
            ],
            {
                name: 'Custom Style'
            });
        var customMapTypeId = 'custom_style';

        var mapProp = {
            center: myLatLng,
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            draggable: false,
            disableDefaultUI: true,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, customMapTypeId]
            }
        };

        function initialize() {
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            map.mapTypes.set(customMapTypeId, customMapType);
            map.setMapTypeId(customMapTypeId);
            var image = {
                url: icon,
                // size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(40, 40)
            };
            var marker = new google.maps.Marker({
                position: markerLatLng,
                map: map,
                animation: google.maps.Animation.BOUNCE,
                icon: image,
                title: 'Travel Armenia'
            });

            var contentString = '<div class="info-beachmarker">';
            if (address) {
                contentString += '<p class="address"><i class="fa fa-map-marker"></i> ' + address + '</p>';
            }
            if (phone) {
                contentString += '<p class="phone"><i class="fa fa-phone"></i> ' + phone + '</p>';
            }
            if (email) {
                contentString += '<p class="mail"><i class="fa fa-envelope-o"></i><a href="mailto:' + email + '"> ' + email + '</a></p>';
            }
            contentString += '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            marker.addListener('click', function () {
                infowindow.open(map, marker);
                // $('.btn-open-map').parents('.map-info').toggle(400);
                // $('#googleMap').css('pointer-events', 'none');
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

        $('.btn-open-map').click(function (event) {
            /* Act on the event */
            $(this).parents('.map-info').toggle(400);
            $('#googleMap').css('pointer-events', 'auto');
            if ($(window).width() > 462) {
                mapProp = {
                    center: markerLatLng,
                    zoom: 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                    disableDefaultUI: true,
                    mapTypeControlOptions: {
                        mapTypeIds: [google.maps.MapTypeId.ROADMAP, customMapTypeId]
                    }
                };
            }
            else {
                mapProp = {
                    center: markerLatLng,
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: true,
                    navigationControl: false,
                    mapTypeControl: false,
                    mapTypeControlOptions: {
                        mapTypeIds: [google.maps.MapTypeId.ROADMAP, customMapTypeId]
                    }
                };
            }

            initialize();
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

// $('.btn-book-hotel').click(function (event) {
//     event.preventDefault();
//     room = $(this).data('target');
//     $('.content-book').html('')
//     $.ajax({
//         url:$(this).attr('href'),
//         type:'post',
//         data:{_token:token},
//         success:function (data) {
//             $('div[data-status="'+room+'"]').html(data);
//             $('.input-daterange').datepicker({
//                 startDate: '0d',
//                 format: 'yyyy-mm-dd',
//                 todayHighlight: true,
//             });
//
//         }
//     })
// });

$('.btn-book-hotel').click(function (event) {
    /* Act on the event */
    event.preventDefault();
    $('.timeline-book-block').toggleClass('show-book-block');
    total_hotel();
});

$(document).on('change', '.child', function () {
    if ($(this).val() > 0) {
        var count = $(this).val();
        $('.child-age').html('');
        var select = '<div class="text-box-wrapper"><select name="child_age[]" class="custom-select child_age" required>' +
            '<option value="">0</option>';
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

function total_hotel() {
    var check_in = $('input[name="check_in"]').val();
    var check_out = $('input[name="check_out"]').val();
    var room = $('select[name="room"]').val();
    var room_count = $('select[name="room_count"]').val();
    var url = total_url;
    $.ajax({
        url: url,
        type: 'post',
        data: {check_in: check_in, check_out: check_out, room: room, room_count: room_count, _token: token},
        success: function (data) {

            if (data['error']) {
                $('.hotel-total-container').fadeOut();
                toastr.error(data['message']);
            } else if (data['success']) {
                $('.hotel-total-container').fadeIn();
                $('.hotel-book-total').find('input[data-name="origin_price"]').val(data['origin_price']);
                $('.hotel-book-total').find('span').text(data['total']);
                $('.count_day').text(data['day']);
                $('.count_night').text(data['night']);
                $('.msg-container').html('');
            }

        }
    })
}

$(document).on('change', '.hotel_total', function () {
    total_hotel();
});

$('.book_data').datepicker({
    format: 'yyyy-mm-dd',
    "setDate": new Date(),
    todayHighlight: true,
}).on('changeDate', function () {
    total_hotel();
});


$('.book-room').submit(function (form) {
    form.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        success: function (data) {
            if (data.success) {
                $('.book-room').trigger('reset');
                $('.timeline-book-block').toggleClass('show-book-block');
                toastr.success(data.message);
                grecaptcha.reset();
            } else {
                toastr.error(data);
                grecaptcha.reset();
            }
        },
        error: function () {
            // location.reload();
        }
    })
});

$(document).ready(function () {
    $('.collapse').addClass('in')
});


