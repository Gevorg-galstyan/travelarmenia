var token = $('meta[name="token"]').attr('content');
$(document).ready(function () {
    $('.cr-slider-wrap').remove();


    $(document).on("change", '.upload3', function () {

        $('.upload-demo3').find(".cr-boundary,.span_reset_file").fadeIn();
        $(".cr-image").fadeIn();
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie("bind", {
                url: e.target.result,
            }).then(function () {
                $w = $('.basic-'),
                    $h = $('.basic-height'),

                    $uploadCrop.croppie('bind', {
                        url: e.target.result,

                    });
            });
        };
        reader.readAsDataURL(this.files[0]);
    });


    $(document).on("change", '.upload2', function () {
        $('.upload-demo4').find(".cr-boundary,.span_reset_file").fadeIn();
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop1.croppie("bind", {
                url: e.target.result,
            }).then(function () {
                $uploadCrop1.croppie('bind', {
                    url: e.target.result,

                });
            });
        };
        reader.readAsDataURL(this.files[0]);
    });

    $('.formImage').submit(function (form) {
        form = form;
        f = $(this);
        $uploadCrop1.croppie('result', {
            type: 'canvas',
            size: {
                width: w1,
                height: h1
            },
        }).then(function (resp) {
            if ($('.upload2').val()) {
                $('input[name="image"]').val(resp);
            }
        });

        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: {
                width: w,
                height: h
            },
        }).then(function (resp) {
            if ($('.upload3 ').val()) {
                $('input[name="imageGeneral"]').val(resp);
            }
        });


    });

    $(document).on('click', ".span_reset_file", function () {
        $(this).parent().find(".cr-image,.cr-boundary,.span_reset_file").fadeOut();
        $('.upload2').val('');
        $('.js-labelFile').removeClass('has-file').find('.js-fileName').text('Change a Image');
        $(this).fadeOut();
    });
});




$('.tour-category').click(function () {
    $('.tour-category').removeClass('active');
    $(this).addClass('active');
    var cat = $(this).data('cat');
    $.ajax({
        url: changeUrl,
        type: 'post',
        data: {cat: cat, _token: token},
        success: function (data) {
            if (data != 0 && data != 'error') {
                $('.tour-content').html(data);
            }
        }
    })
});


$(document).on('click', '.delete-image', function (e) {
    var url = $(this).data('href');
    var number = $(this).data('target');
    parent = $('[data-status="' + number + '"]');
    $.ajax({
        url: url,
        type: 'post',
        data: {_token: token},
        success: function (e) {
            if (e == 1) {
                $(parent).fadeIn($(parent).remove());
            }
        }
    })
});


$('.count-room').change(function () {
    var count = $(this).val();
    var url = $(this).data('href');
    var country = $('.country').val();
    if (count) {
        $.ajax({
            url: url,
            type: 'post',
            data: {count: count, country: country, _token: token},
            success: function (data) {
                $('.room-content').html(data);
                $('.editor').ckeditor();

            }
        })
    }
});

$(document).on('click', '.delete-content', function () {
    var delete_key = $(this).data('delete');

    $('[data-content="' + delete_key + '"]').fadeOut("slow", function () {
        $(this).remove();
        var count = $('.destination_number');
        // for (var i = 0; i <= count.length; i++){
        //     count[i].text(i)
        // }
        $('.destination-count').each(function (i) {
            $(this).find('.destination_number').html(parseInt(parseInt(i) + parseInt(1)));
            $(this).find('.destination-image').attr('name', 'images[' + i + '][]');
        });
    });

});


//select checkbox
// var options = [];
//
// $('.dropdown-menu a').on('click', function (event) {
//
//     var $target = $(event.currentTarget),
//         val = $target.attr('data-value'),
//         $inp = $target.find('input'),
//         idx;
//
//     if (( idx = options.indexOf(val) ) > -1) {
//         options.splice(idx, 1);
//         setTimeout(function () {
//             $inp.prop('checked', false)
//         }, 0);
//     } else {
//         options.push(val);
//         setTimeout(function () {
//             $inp.prop('checked', true)
//         }, 0);
//     }
//
//     $(event.target).blur();
//
//     console.log(options);
//     return false;
// });

$(document).on('change', '.select-country', function () {
    var cat = $(this).val();
    var url = $(this).data('href');
    $.ajax({
        url: url,
        type: 'post',
        data: {change_country: cat, _token: token},
        success: function (data) {
            $('.city-content').html(data);
            $('.types-content').html(data);
            $('.selectpicker').selectpicker();
            $('.pricing-content').html('');
        }
    })
});

$('.price-row, .column').change(function () {
    if ($(this).val() < 1) {
        $(this).val(1);
    }
});

$('.create-pricing-table').click(function () {

    if ($('.price-row').val() && $('.column').val()) {
        $('.error-pricing').hide();
        var row = $('.price-row').val();
        var column = $('.column').val();
        var url = $(this).data('href');
        var country_id = $('select[name="country_id"]').val();
        $.ajax({
            url: url,
            type: 'post',
            data: {row: row, column: column, country_id: country_id, _token: token},
            success: function (data) {
                $('.pricing-content').html(data)
            }
        })


    }
});


$(document).on('click', '.delete-pricing', function () {
    var td = $(this).data('target');
    $('[data-status="' + td + '"]').fadeOut("slow", function () {
        $('[data-status="' + td + '"]').remove();
    });
});

var delete_date = 1;
$(document).on('click', '.add_date', function () {
    if ($('.date-column').length > 0) {
        $('.date-column').append(
            '<div class="col-sm-4" data-status="delete_date_' + parseInt(delete_date + 1) + '">\n' +
            '                                        <div class="panel panel-info ">\n' +
            '                                            <div class="panel panel-body text-center">\n' +
            '                                                <div class=" text-center input-group"">\n' +
            '                                                    <div class="form-group">\n' +
            '                                                        <label for="sel1" class="text-center">Check in</label>\n' +
            '                                                        <input type="date" class="input-sm form-control" name="start[]" required/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="form-group">\n' +
            '                                                        <label for="sel1" class="text-center">Check out</label>\n' +
            '                                                        <input type="date" class="input-sm form-control" name="end[]" required/>\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                            <button type="button" class="btn btn-danger delete_date" data-target="delete_date_' + parseInt(delete_date + 1) + '">\n' +
            '                                                <i class="fa fa-trash"></i>\n' +
            '                                            </button>\n' +
            '                                        </div>\n' +
            '                                    </div>'
        )
    }
    delete_date++;
});

$(document).on('click', '.delete_date', function () {
    var date = $(this).data('target');
    $('[data-status="' + date + '"]').fadeOut('show', function () {
        $('[data-status="' + date + '"]').remove();
    })
});

$('.edit-modal').click(function () {
    var url = $(this).data('href');
    $.ajax({
        url: url,
        type: 'post',
        data: {edit: true, _token: token},
        success: function (data) {
            $('.content-model').html(data);
            $('.editor').ckeditor();
        }
    });
});
// Delete Row pricing
$(document).on('click', '.delete-row', function () {
    tr = $(this).parents('tr');
    tr.fadeOut('show', function () {
        tr.remove();
    })
});

$('.add-row').click(function () {
    var row = $(".one-td:last").clone();
    var number = parseInt($(".one-td:last").data('number')) + 1;
    $(".row-body").append(row);
    $(".one-td:last input").val('').attr('name', 'individual_price[' + number + '][]');
    $(".one-td:last select option:first").prop("selected", true);
    $(".one-td:last select").attr('name', 'hotel_id[' + number + ']')
});

$('.add-column').click(function () {
    var th = $('.one-th:last');
    var number = parseInt(th.data('th')) + 1;
    th.after('<th data-status="count_' + number + '" data-th="' + number + '" class="one-th">\n' +
        '                                                <button type="button"\n' +
        '                                                        class=" btn-danger pull-right delete-pricing"\n' +
        '                                                        data-target="count_' + number + '">\n' +
        '                                                    <i class="fa fa-close"></i>\n' +
        '                                                </button>\n' +
        '                                                <input type="text"\n' +
        '                                                       class="form-control"\n' +
        '                                                       name="man_count[]"\n' +
        '                                                       placeholder="Enter Count Man">\n' +
        '                                            </th>');
    $('td[data-status="' + th.data('status') + '"]').each(function () {
        var name = $(this).find('input').attr('name');
        $(this).after(' <td data-status="count_' + number + '">\n' +
            '                                                    <input type="text"\n' +
            '                                                           class="form-control"\n' +
            '                                                           placeholder="Enter Price" name="' + name + '"\n' +
            '                                                </td>')
    })

});

$('.cover-image-section-name').click(function () {
    var section_name = $(this).data('section');
    $('input[name="section"]').val(section_name);
});


$(".chkParent").click(function () {
    var parentState = this.checked;
    $('.chkChild').each(function () {
        this.checked = parentState;
    });
});

$(".chkChild").click(function () {
    if ($('.chkChild').length != $(".chkChild:checked").length) {
        $(".chkParent").prop("checked", false);
    }
    else {
        $(".chkParent").prop("checked", true);
    }
});
$(document).on('change', 'input[type="checkbox"]', function () {
    if ($('input[name="row_id"]:checked').length > 0){
        $('.open-subscriber-modal').prop('disabled', false).attr('title', 'открыть текст подписчиков ');
    }else {
        $('.open-subscriber-modal').prop('disabled', true);
    }
});
$('.subscriber-form').submit(function (form) {
    form.preventDefault();
    var emails = [];
   $('input[name="row_id"]:checked').each(function () {
       var selector = $(this).data('target');
       emails.push($('[data-status="'+selector+'"]').text())
   });
     var subject = $('input[name="subject"]').val();
     var text = $('#text').val();
     // var text = tinyMCE.editors['text'].getContent();
     // if (text == ''){
     //     toastr.warning('поле текст не может быть пустым ');
     // }else{
         var token = $('input[name="_token"]').val();
         $.ajax({
             url:$('.subscriber-form').attr('action'),
             type:$('.subscriber-form').attr('method'),
             data:{subject:subject, text:text, _token:token},
             success:function (data) {
                 if (data['success']){
                     toastr.success(data['message']);
                 }else{
                     toastr.error(data);
                 }
             }
         })
     // }
});


$(document).on('click', '.change-hotel-name', function () {
   var number = $(this).data('target');
   var select = $(this).parent().parent().find('select');
   var ru_name = $('input[name="hotel_name_ru['+number+']"]');
   var en_name = $('input[name="hotel_name_en['+number+']"]');
    if ($(select).is(':disabled')){
        ru_name.prop('disabled', true).hide();
        en_name.prop('disabled', true).hide();
        select.prop('disabled', false).show();
    }else{
        ru_name.prop('disabled', false).show();
        en_name.prop('disabled', false).show();
        select.prop('disabled', true).hide();
    }
});

$('.tour-country').change(function () {
   $('.pricing-content').html('')
});