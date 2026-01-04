(function ($) {
    "use strict";

    var x = setInterval(function () {

        try {
            if (oldTime < new Date().getSeconds() || (oldTime == 59 && 0 == new Date().getSeconds())) {
                
                oldTime = new Date().getSeconds();

                // Get today's date and time
                currentTime.setSeconds(currentTime.getSeconds() + 1); // Decrement by 1 second

                // Find the distance between currentTime and the count down date
                var distance = countDownDate - currentTime.getTime();
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Format minutes and seconds with leading zeros
                var formattedMinutes = String(minutes).padStart(2, '0');
                var formattedSeconds = String(seconds).padStart(2, '0');
                console.log(formattedMinutes, formattedSeconds, distance);

                // Output the result in an element with id="send-after-timer"
                $("#send-after-timer").html(formattedMinutes + ":" + formattedSeconds);

                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    $("#send-after-timer").parent().addClass("d-none");
                    $("#resent-div").removeClass("d-none");
                    $("#verify-btn").addClass("d-none");
                    $("#otp-block").addClass("d-none");
                }

            }
        } catch ($e) {
        }
    }, 1000);



    $.fn.OTPInput = function () {
        return this.each(function () {
            const inputs = $(this).find('*[id]');
            inputs.each(function (i) {
                $(this).on('keydown', function (event) {
                    if (event.key === "Backspace") {
                        $(this).val('');
                        if (i !== 0) {
                            inputs.eq(i - 1).focus();
                        }
                    } else {
                        if (i === inputs.length - 1 && $(this).val() !== '') {
                            return true;
                        } else if (event.keyCode > 47 && event.keyCode < 58) {
                            $(this).val(event.key);
                            if (i !== inputs.length - 1) {
                                inputs.eq(i + 1).focus();
                            }
                            event.preventDefault();
                        } else if (event.keyCode > 64 && event.keyCode < 91) {
                            $(this).val(String.fromCharCode(event.keyCode));
                            if (i !== inputs.length - 1) {
                                inputs.eq(i + 1).focus();
                            }
                            event.preventDefault();
                        }
                    }
                });
            });
        });
    };

    $(document).ready(function () {
        $('#otp-block').OTPInput();
    });
})(jQuery);
