(function ($) {
    "use strict";
    $('#faqDataTable').DataTable({
        lengthChange: false,
        ordering: false,
        serverSide: true,
        searching: false,
        paging: false,
        info: false,
        ajax: $('#faq_setting').val(),
        dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>tr<"bottom"<"row"<"col-sm-6"i><"col-sm-6"p>>><"clear">',
        columns: [
            {"data": "title", "name": "title"},
            {"data": "description", "name": "description"},
            {"data": "status", "name": "status"},
            {"data": "action", "name": "action", responsivePriority:2},
        ]
    });
})(jQuery)
