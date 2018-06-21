$('.tour-filter').change(function () {
    tour_filter();
    window.location.href = filter_url+'?'+(i_g ? 'i_g='+i_g+'&' : '')+'type='+type;
});


function tour_filter() {
    type = $('input[name="type"]:checked').val() ? $('input[name="type"]:checked').val() : '';
}

$('.individual_groups').change(function () {
    if ($(this).val()){
        window.location.href = filter_url+'?i_g='+$(this).val();
    }
});