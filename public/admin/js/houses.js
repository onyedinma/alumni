(function ($) {
    "use strict";

    var houseDataTable = $('#houseDataTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        responsive: true,
        ajax: $('#house-route').val(),
        order: [[1, 'asc']],
        ordering: true,
        searching: true,
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            searchPlaceholder: "Search houses...",
            search: "",
        },
        dom: '<"row"<"col-sm-4"l><"col-sm-4"B><"col-sm-4"f>>tr<"row"<"col-sm-5"i><"col-sm-7"p>>',
        columns: [
            { "data": "DT_RowIndex", "name": "DT_RowIndex", orderable: false, searchable: false },
            { "data": "name", "name": "name" },
            { "data": "color_preview", "name": "color_preview", orderable: false, searchable: false },
            { "data": "status", "name": "status" },
            { "data": "action", "name": "action", orderable: false, searchable: false }
        ]
    });

    // Edit button click handler
    $(document).on('click', '.edit', function () {
        var id = $(this).data('id');
        var url = $('#house-route').val() + '/edit/' + id;

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                $('#edit-modal .modal-content').html(response);
                $('#edit-modal').modal('show');
            },
            error: function (xhr) {
                toastr.error('Failed to load house data');
            }
        });
    });

})(jQuery);
