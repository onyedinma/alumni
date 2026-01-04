(function ($) {
    "use strict";
    $('#frontendSectionDataTable').DataTable({
        lengthChange: false,
        ordering: false,
        serverSide: true,
        searching: false,
        paging: false,
        info: false,
        ajax: $('#frontend-section').val(),
        dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>tr<"bottom"<"row"<"col-sm-6"i><"col-sm-6"p>>><"clear">',
        columns: [
            {"data": "id", "name": "id"},
            {"data": "name", "name": "name"},
            {"data": "title", "name": "title"},
            {"data": "image", "name": "image"},
            {"data": "status", "name": "status","className": "text-center"},
            {"data": "action", "name": "action"},
        ]
    });
})(jQuery)
