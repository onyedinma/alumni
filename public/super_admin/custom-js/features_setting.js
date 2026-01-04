(function ($) {
    "use strict";
    $('#featuresDataTable').DataTable({
        lengthChange: false,
        ordering: false,
        serverSide: true,
        searching: false,
        paging: false,
        info: false,
        ajax: $('#features_setting').val(),
        dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>tr<"bottom"<"row"<"col-sm-6"i><"col-sm-6"p>>><"clear">',
        columns: [
            { "data": "icon", "name": "icon" },
            { "data": "title", "name": "title" },
            { "data": "status", "name": "status" },
            { "data": "action", "name": "action", responsivePriority: 2 },
        ]
    });
})(jQuery)
