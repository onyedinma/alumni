<!-- js file  -->
<script src="{{ asset('frontend/js/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/plugins.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('common/js/common.js') }}"></script>

@stack('script')

<script>
    var currencySymbol = "{{ getCurrencySymbol() }}";
    var currencyPlacement = "{{ getCurrencyPlacement() }}";

    @if (Session::has('success'))
        toastr.success("{{ session('success') }}");
    @endif
    @if (Session::has('error'))
        toastr.error("{{ session('error') }}");
    @endif
    @if (Session::has('info'))
        toastr.info("{{ session('info') }}");
    @endif
    @if (Session::has('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if (@$errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

    // Robust preloader fadeout - disable pointer events immediately
    (function () {
        var preloader = document.getElementById('preloader');
        if (preloader) {
            // Immediately disable pointer events to prevent blocking
            preloader.style.pointerEvents = 'none';
            preloader.style.opacity = '0';
            // Remove after fade transition
            setTimeout(function () {
                if (preloader.parentNode) {
                    preloader.parentNode.removeChild(preloader);
                }
            }, 500);
        }
    })();

    // Also run on window load as backup
    $(window).on('load', function () {
        var preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.pointerEvents = 'none';
            $('#preloader').fadeOut('slow', function () {
                $(this).remove();
            });
        }
    });
</script>