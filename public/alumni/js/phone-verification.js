(function ($) {
	"use strict";

	$(document).on('click', '.resend-otp', function (e) {
		commonAjax('GET', $('#resendRoute').val(), commonResponse, commonResponse, '');
	});

	window.responseForSendSMS = function(response){
		"use strict";
		$('.error-message').remove();
		$('.is-invalid').removeClass('is-invalid');
		if (response['status'] === true) {
			toastr.success(response['message'])
	
			setTimeout(() => {
				$(".send-otp-section").addClass('d-none');
				$(".verify-otp-section").removeClass('d-none');
			}, 1000);
	
	
		} else {
			commonHandler(response)
		}
	}
	window.responseForReSendSMS = function(response){
		"use strict";
		$('.error-message').remove();
		$('.is-invalid').removeClass('is-invalid');
		if (response['status'] === true) {
			toastr.success(response['message'])
	
			setTimeout(() => {
				$(".send-otp-section").addClass('d-none');
				$(".verify-otp-section").removeClass('d-none');
			}, 1000);
	
	
		} else {
			commonHandler(response)
		}
	}
})(jQuery);

