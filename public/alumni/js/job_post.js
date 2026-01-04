(function ($) {
	"use strict";
	$("#jobPostDataTable").DataTable({
		pageLength: 10,
		ordering: false,
		serverSide: true,
		processing: true,
        responsive: true,
		searching: true,
		ajax: $('#job-post-list-route').val(),
		language: {
			paginate: {
				previous: "<i class='fa-solid fa-angles-left'></i>",
				next: "<i class='fa-solid fa-angles-right'></i>",
			},
			searchPlaceholder: "Search Job Posts",
			search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
		},
		dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"tableSearch float-start"f>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
		columns: [
			{ "data": "company_logo", "name": "company_logo", searchable: false},
			{ "data": "title", "name": "title",responsivePriority:1 },
			{ "data": "employee_status", "name": "employee_status" },
            { "data": "salary", "name": "salary" },
            { "data": "application_deadline", "name": "application_deadline" },
			{ "data": "status", "name": "status" },
			{ "data": "action", searchable: false, responsivePriority: 2},
		],
	});

    $("#jobPostAlldataTable").DataTable({
		pageLength: 10,
		ordering: false,
		serverSide: true,
		processing: true,
        responsive: true,
		searching: true,
		ajax: $('#job-post-list-route').val(),
		language: {
			paginate: {
				previous: "<i class='fa-solid fa-angles-left'></i>",
				next: "<i class='fa-solid fa-angles-right'></i>",
			},
			searchPlaceholder: "Search Job Posts",
			search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
		},
		dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"tableSearch float-start"f>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
		columns: [
			{ "data": "company_logo", "name": "company_logo", searchable: false, responsivePriority: 1 },
			{ "data": "title", "name": "title" },
			{ "data": "employee_status", "name": "employee_status" },
            { "data": "salary", "name": "salary" },
            { "data": "application_deadline", "name": "application_deadline" },
			// { "data": "status", "name": "status" },
			{ "data": "action", searchable: false, responsivePriority: 2 },
		],
	});
    $("#jobPostPendingdataTable").DataTable({
		pageLength: 10,
		ordering: false,
		serverSide: true,
		processing: true,
        responsive: true,
		searching: true,
		ajax: $('#job-post-list-route').val(),
		language: {
			paginate: {
				previous: "<i class='fa-solid fa-angles-left'></i>",
				next: "<i class='fa-solid fa-angles-right'></i>",
			},
			searchPlaceholder: "Search Job Posts",
			search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
		},
		dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"tableSearch float-start"f>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
		columns: [
			{ "data": "company_logo", "name": "company_logo", searchable: false, responsivePriority: 1 },
			{ "data": "title", "name": "title" },
			{ "data": "employee_status", "name": "employee_status" },
            { "data": "salary", "name": "salary" },
            { "data": "application_deadline", "name": "application_deadline" },
			{ "data": "status", "name": "status" },
			{ "data": "action", searchable: false, responsivePriority: 2 },
		],
	});

})(jQuery)

