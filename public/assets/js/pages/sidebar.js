jQuery(function($) {
    "use strict";

    var SLZ = window.SLZ || {};
    // js for calendar
    var lang = $('html').attr('lang');
    SLZ.datepick = function() {
        $('.input-daterange, .archive-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: lang,
            startDate: "d",
            inline: true,
            sideBySide: true,
            maxViewMode: 0,
            timePicker: true,
            todayHighlight: true
        });
    };

    // js for slide time
    SLZ.rangeSliderVisualize = function() {



    };

    /*======================================
    =            INIT FUNCTIONS            =
    ======================================*/

    $(document).ready(function() {
        SLZ.datepick();
        SLZ.rangeSliderVisualize();
    });
    /*=====  End of INIT FUNCTIONS  ======*/

});
