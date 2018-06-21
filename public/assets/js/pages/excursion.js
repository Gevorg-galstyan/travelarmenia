$('.btn-book-excursion').click(function (event) {
    event.preventDefault();
    $('.timeline-book-block').removeClass('show-book-block');
    var url = $(this).data('url');
    var token = $('meta[name="token"]').attr('content');
    var data_excursion = $(this).data('target');
    form_container = $('.timeline-book-block[data-status="' + data_excursion + '"]');
    $.ajax({
        url: url,
        type: 'post',
        data: {_token: token},
        success: function (data) {

            form_container.addClass('show-book-block');
            form_container.html(data)
            $('.input-daterange').datepicker({
                startDate: 0,
                language: "ru",
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                timePicker: true,
                todayBtn: 1,
            });
        }
    })
});

$(document).on('change', '.child', function () {
    if ($(this).val() > 0) {
        var count = $(this).val();
        $('.child-age').html('');
        var select = '<div class="text-box-wrapper"><select name="child_age[]" class="custom-select child_age change-total" required>' +
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

$(document).on('change', '.change-total', function () {
    $.ajax({
        url: change_total_url,
        type:'post',
        data:$('.book-excursion').serialize(),
        success:function (data) {
            if (data['error']) {
                // $('.hotel-total-container').fadeOut();
                toastr.error(data['message']);
            } else if (data['success']) {
                $('.excursion-book-per-person').find('input[data-name="origin_price"]').val(data['origin_price_per_person']);
                $('.excursion-book-per-person').find('span').text(data['price_per_person']);
                $('.excursion-book-total').find('input[data-name="origin_price"]').val(data['origin_total']);
                $('.excursion-book-total').find('span').text(data['total']);

            }
        }
    })
});

$(document).on('submit', '.book-excursion', function (form) {
   form.preventDefault();
   if (!$(this).find("#g-recaptcha-response").val()){
       toastr.error('Please check the recaptcha');
   }else {
       $.ajax({
           url:$(this).attr('action'),
           type:$(this).attr('method'),
           data:$(this).serialize(),
           success:function (data) {
               if (data.success) {
                   $('.book-excursion').trigger('reset');
                   $('.timeline-book-block').toggleClass('show-book-block');
                   toastr.success(data.message);
                   grecaptcha.reset();
               } else {
                   toastr.error(data);
                   grecaptcha.reset();
               }
           }
       })
   }
});


