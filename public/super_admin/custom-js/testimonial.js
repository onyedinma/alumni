(function ($) {
    "use strict";
    $('#testimonialDataTable').DataTable({
        lengthChange: false,
        ordering: false,
        serverSide: true,
        searching: false,
        paging: false,
        info: false,
        ajax: $('#testimonial-area').val(),
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            searchPlaceholder: "Search",
            search: ""
        },
        dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"tableSearch float-start"f>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',

        columns: [
            {"data": "name", "name": "name"},
            {"data": "image", "name": "image", searchable: false, responsivePriority:1},
            {"data": "designation", "name": "designation"},
            {"data": "status", "name": "status"},
            {"data": "action", searchable: false, responsivePriority:2},
        ]
    });


})(jQuery)
