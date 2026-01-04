(function ($) {
    "use strict";

    $("#customerTransactionTable").DataTable({
        pageLength: 10,
        ordering: false,
        serverSide: true,
        responsive: true,
        processing: true,
        searching: false,
        ajax: $('#customer-transaction-route').val(),
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            searchPlaceholder: "Search event",
            search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
        },
        dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"tableSearch float-start"f>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
        columns: [
            { "data": "purpose", "name": "purpose" },
            { "data": "tnxId", "name": "tnxId" },
            { "data": "payment_method", "name": "payment_method" },
            { "data": "date", "name": "date" },
            { "data": "amount", "name": "amount", responsivePriority: 2 },
        ],
    });

    $("#domain-information-list").DataTable({
        pageLength: 10,
        ordering: false,
        serverSide: false,
        responsive: true,
        processing: true,
        searching: false,
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            searchPlaceholder: "Search event",
            search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
        },
        dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"tableSearch float-start"f>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
    });

})(jQuery)


