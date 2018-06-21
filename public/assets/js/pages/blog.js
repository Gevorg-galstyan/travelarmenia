jQuery(function($){
    "use strict";

    var SLZ = window.SLZ || {};


    /*=======================================
    =             MAIN FUNCTION             =
    =======================================*/

    SLZ.mainFunction = function(){

        // VOTE RANGTING
        $('.stars-rating span a').on('click', function(e){
            alert(2)
            e.preventDefault();
            $('.stars-rating span').find('a').removeClass('active');
            $(this).addClass('active');
        });
    };

    /*======================================
    =            INIT FUNCTIONS            =
    ======================================*/

    $(document).ready(function(){
        SLZ.mainFunction();
    });

    /*======================================
    =          END INIT FUNCTIONS          =
    ======================================*/

});
$('.archive-datepicker').on('changeDate', function (e) {
    var dateVal = e.format('yyyy-mm-dd');
    var url = $('.archive-datepicker').data('url');
    window.location.href = url + '?date=' + dateVal
});
var lang = $('html').attr('lang');
$('.archive-datepicker').datepicker({
    format: 'yyyy-mm-dd',
    language: lang,
    sideBySide: true,
    // maxViewMode: 0,
    endDate: '+0d',
    todayBtn: "linked",
    // minDate: "2018-05-12"
    // weekStart: "2018-05-12"
});