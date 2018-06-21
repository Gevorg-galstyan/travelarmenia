$('.hotel-filter').change(function () {
    hotelf_filter();
    window.location.href = filter_url+'?star='+star+'&type='+type;
});


function hotelf_filter() {
    star = $('input[name="rating"]:checked').val() ? $('input[name="rating"]:checked').val() : '';
    type = $('input[name="accommodation"]:checked').val() ? $('input[name="accommodation"]:checked').val() : '';
}