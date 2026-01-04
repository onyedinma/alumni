(function ($) {
    "use strict";

    $(window).on('load', function () {
        printDiv();
    });

    window.printDiv = function () {
        var printContents = document.getElementById('printableArea').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    };
    
})(jQuery)
