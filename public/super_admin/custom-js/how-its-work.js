(function ($) {
    "use strict";
    $('#howItsWorkDataTable').DataTable({
        lengthChange: false,
        ordering: false,
        serverSide: true,
        searching: false,
        paging: false,
        info: false,
        ajax: $('#how-its-work').val(),
        dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>tr<"bottom"<"row"<"col-sm-6"i><"col-sm-6"p>>><"clear">',
        columns: [
            { "data": "image", "name": "image" },
            { "data": "name", "name": "name" },
            { "data": "title", "name": "title" },
            { "data": "status", "name": "status" },
            { "data": "action", "name": "action", responsivePriority: 2 },
        ]
    });
})(jQuery)
