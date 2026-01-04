(function ($) {
    ("use strict");
    $(document).on('click', '#add', function () {
        var selector = $('#addModal');
        selector.find('.otherFields').html('');
        selector.modal('show');
    });

    $(document).on('change', 'select[name=alumni_limit_type],select[name=event_limit_type]', function () {
        var selector = $(this).closest('div');
        if ($(this).val() == 1) {
            selector.find('input').prop('disabled', false);
        } else {
            selector.find('input').val(0);
            selector.find('input').prop('disabled', true);
        }
    });

    $(document).on('click', '.addOtherField', function () {
        var selector = $(this).closest('.modal')
        selector.find('.otherFields').append(otherFiledTemplate());
    });

    $(document).on('click', '.removeOtherField', function () {
        $(this).closest('.input-group').remove();
    });

    function otherFiledTemplate() {
        return `<div class="input-group mb-3 flex-nowrap mt-3">
                    <input type="text" name="others[]" class="primary-form-control" value="">
                    <button type="button" class="bg-danger input-group-text text-white removeOtherField"><i class="fa fa-trash-can"></i></button>
                </div>`;
    }

    $("#packageDataTable").DataTable({
        pageLength: 10,
        ordering: false,
        serverSide: true,
        processing: true,
        responsive: {
            breakpoints: [
                { name: "desktop", width: Infinity },
                { name: "tablet", width: 1400 },
                { name: "fablet", width: 768 },
                { name: "phone", width: 480 },
            ],
        },
        searching: false,
        ajax: $('#packageIndexRoute').val(),
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            searchPlaceholder: "Search event",
            search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
        },
        dom: '<>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
        columns: [
            { data: 'DT_RowIndex', "name": 'DT_RowIndex', orderable: false, searchable: false, },
            { data: "icon" },
            { data: "name", name: "name" },
            { data: "monthly_price", name: "monthly_price" },
            { data: "yearly_price", name: "yearly_price" },
            { data: "status", name: "status" },
            { data: "action", name: "action" },
        ],
    });

    $('#assignPackage').on('click', function () {
        var selector = $('#assignPackageModal');
        selector.find('.is-invalid').removeClass('is-invalid');
        selector.find('.error-message').remove();
        selector.find('form').trigger('reset');
        selector.modal('show')
    })

    $("#packageUserDataTable").DataTable({
        pageLength: 10,
        ordering: false,
        serverSide: true,
        processing: true,
        responsive: {
            breakpoints: [
                { name: "desktop", width: Infinity },
                { name: "tablet", width: 1400 },
                { name: "fablet", width: 768 },
                { name: "phone", width: 480 },
            ],
        },
        searching: false,
        ajax: $('#packagesUserRoute').val(),
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            searchPlaceholder: "Search event",
            search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
        },
        dom: '<>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, },
            { data: "user_name", name: "users.name" },
            { data: "email", name: "users.email" },
            { data: "package_name", name: "packages.name" },
            { data: "gateway_name", name: "gateways.title" },
            { data: "start_date", name: "owner_packages.start_date" },
            { data: "end_date", name: "owner_packages.end_date" },
            { data: "status", name: "user_packages.status" }
        ],
    });

})(jQuery);
