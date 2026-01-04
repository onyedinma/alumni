(function ($) {
    "use strict";

    $(document).on('click', '.templateConfigure', function () {
        var category = $(this).closest('tr').find('input[name=category]').val()
        commonAjax('GET', $('#emailTemplateConfigRoute').val(), emailTemplateConfigRes, emailTemplateConfigRes, { 'category': category })
    });

    function emailTemplateConfigRes(response) {
        if (response['status'] == true) {
            var selector = $('#emailConfigureModal');
            var fields = '';
            Object.entries(response.data.fields).forEach((field) => {
                fields += '<span class="singleField" data-field="' + field[0] + '">' + field[0] + '</span>';
            });
            selector.find('.templateFields').html(fields);
            selector.find('input[name=category]').val(response.data.template.category);
            selector.find('input[name=subject]').val(response.data.template.subject);
            selector.find('textarea[name=body]').summernote('code', response.data.template.body);
            selector.modal('show');
        } else {
            commonHandler(response)
        }
    }

})(jQuery)
