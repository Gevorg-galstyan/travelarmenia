$('.car-filter').change(function () {
    car_filter();
    window.location.href = filter_url+'?car_type='+car_type+'&car_mark='+car_mark+'&price_min='+price_min+'&price_max='+price_max;
});


function car_filter() {
    car_type = $('input[name="car_type"]:checked').val() ? $('input[name="car_type"]:checked').val() : '';
    car_mark = $('input[name="car_mark"]:checked').val() ? $('input[name="car_mark"]:checked').val() : '';
}