(function ($) {
    ("use strict");

    $(document).on('click', '.orderPayStatus', function () {
        commonAjax('GET', $('#ordersGetInfoRoute').val(), getInfoRes, getInfoRes, { 'id': $(this).data('id') });
    });

    function getInfoRes(response) {
        const selector = $('#payStatusChangeModal');
        selector.find('input[name=id]').val(response.data.id)
        selector.find('select[name=status]').val(response.data.payment_status)
        selector.modal('show')
    }

    $(document).ready(function () {
        allOrderDataTable('All')
    });

    $(document).on('click', '.orderStatusTab', function (e) {
        var status = $(this).data('status');
        allOrderDataTable(status)
    });

    function allOrderDataTable(status) {
        var dataTableColumns = [
            { "data": "tnxId" },
            { "data": "userName" },
            { "data": "userEmail" },
            { "data": "package" },
            { "data": "gateway" },
            { "data": "amount" },
            { "data": "date" },
            { "data": "status" }
        ];
        if(status == 'Pending'){
            dataTableColumns.push({ "data": "payment_info", responsivePriority: 2 });
            dataTableColumns.push({ "data": "action", responsivePriority: 2 });
        }

        $("#orderDataTable" + status).DataTable({
            pageLength: 10,
            ordering: false,
            serverSide: true,
            processing: true,
            searching: false,
            responsive: {
                breakpoints: [
                    { name: "desktop", width: Infinity },
                    { name: "tablet", width: 1400 },
                    { name: "fablet", width: 768 },
                    { name: "phone", width: 480 },
                ],
            },
            ajax: {
                url: $('#ordersStatusRoute').val(),
                data: function (data) {
                    data.status = status;
                }
            },
            language: {
                paginate: {
                    previous: "<i class='fa-solid fa-angles-left'></i>",
                    next: "<i class='fa-solid fa-angles-right'></i>",
                },
                searchPlaceholder: "Search pending event",
                search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
            },
            dom: '<>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
            columns: dataTableColumns,
            stateSave: true,
            "bDestroy": true
        });
    }
})(jQuery);
