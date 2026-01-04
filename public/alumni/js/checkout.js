(function ($) {
    "use strict";

    $('#bank_id').on('change', function () {
        $('#bankDetails').removeClass('d-none');
        $('#bankDetails p').html($(this).find(':selected').data('details'));
    });
    
    $(document).on('click', '.paymentItem-btn', function () {
        $('#selectGateway').val($(this).data('gateway').replace(/\s+/g, ''))
        $('#selectCurrency').val('');
        commonAjax('GET', $('#getCurrencyByGatewayRoute').val(), getCurrencyRes, getCurrencyRes, { 'id': $(this).find('input').val() });

        if ($('#selectGateway').val() == 'bank') {
            $('#bankDetails').removeClass('d-none');
            $('#bank_slip').attr('required', true);
            $('#bank_id').attr('required', true);
        } else {
            $('#bank_slip').attr('required', false);
            $('#bank_id').attr('required', false);
            $('#bankDetails').addClass('d-none');
        }
    });
    
    window.getCurrencyRes = function(response) {
        var html = '';
        var invoiceAmount = parseFloat($('#amount').val()).toFixed(2);
        Object.entries(response.data).forEach((currency) => {
            let currencyAmount = currency[1].conversion_rate * invoiceAmount;
            html += `<li>
            <button type="button" class="paymentItem gatewayCurrencyAmount">
              <div class="d-flex align-items-center cg-10">
                <input required value="${gatewayCurrencyPrice(currencyAmount, currency[1].symbol)}" class="paymentItem-input form-check-input" type="radio" id="currency-pay-${currency[1].id}" name="gateway_currency_amount">
                <label class="currency-label" for="currency-pay-${currency[1].id}">${currency[1].currency}</label>
              </div>
              <div class="d-flex">${gatewayCurrencyPrice(currencyAmount, currency[1].symbol)}</div>
            </button>
          </li>`;
        });
        $('#currencyAppend').html(html);
    }
    
    $(document).on('click', '.gatewayCurrencyAmount', function () {
        var getCurrencyAmount = '(' + $(this).find('input').val() + ')';
        $('#gatewayCurrencyAmount').text(getCurrencyAmount);
        $('#selectCurrency').val($(this).find('.currency-label').text().replace(/\s+/g, ''));
    });
    
    $('#payBtn').on('click', function () {
        var gateway = $('#selectGateway').val()
        var currency = $('#selectCurrency').val();
        if (gateway == '') {
            toastr.error('Select Gateway');
            $('#payBtn').attr('type', 'button');
        } else {
            if (currency == '') {
                toastr.error('Select Currency');
                $('#payBtn').attr('type', 'button');
            } else {
                $('#payBtn').attr('type', 'submit');
            }
        }
    }); 

    window.addEventListener('load', function(){
        $(document).find('[data-gateway=paypal]').trigger('click'); 
    })

})(jQuery)
