<!-- js file  -->
<script src="{{ asset('assets/js/jquery-3.7.0.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins.js')}}"></script>
<script src="{{ asset('assets/js/dataTables.js')}}"></script>
<script src="{{ asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/css/summernote/summernote-lite.min.js') }}"></script>
<script src="{{ asset('assets/js/lc_select.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js')}}?ver={{ env('VERSION', 0) }}"></script>
<script src="{{ asset('common/js/common.js')}}?ver={{ env('VERSION', 0) }}"></script>

@stack('script')

<script>
	var currencySymbol = "{{ getCurrencySymbol() }}";
	var currencyPlacement = "{{ getCurrencyPlacement() }}";

	@if(Session::has('success'))
		toastr.success("{{ session('success') }}");
	@endif
	@if(Session::has('error'))
		toastr.error("{{ session('error') }}");
	@endif
	@if(Session::has('info'))
		toastr.info("{{ session('info') }}");
	@endif
	@if(Session::has('warning'))
		toastr.warning("{{ session('warning') }}");
	@endif

	@if (@$errors->any())
		@foreach ($errors->all() as $error)
			toastr.error("{{ $error }}");
		@endforeach
	@endif

	// Register Service Worker for PWA
	if ('serviceWorker' in navigator) {
		window.addEventListener('load', function () {
			navigator.serviceWorker.register('/sw.js')
				.then(function (registration) {
					console.log('SW registered: ', registration);
				})
				.catch(function (registrationError) {
					console.log('SW registration failed: ', registrationError);
				});
		});
	}

	// Mobile Sidebar Toggle
	$(document).ready(function () {
		var sidebar = $('.zSidebar');
		var overlay = $('#sidebarOverlay');
		var menuBtn = $('.mobileMenu button');

		menuBtn.on('click', function (e) {
			e.preventDefault();
			sidebar.toggleClass('active');
			overlay.toggleClass('active');
			$('body').toggleClass('sidebar-open');
		});

		overlay.on('click', function () {
			sidebar.removeClass('active');
			overlay.removeClass('active');
			$('body').removeClass('sidebar-open');
		});

		// Close on escape key
		$(document).on('keydown', function (e) {
			if (e.key === 'Escape' && sidebar.hasClass('active')) {
				sidebar.removeClass('active');
				overlay.removeClass('active');
				$('body').removeClass('sidebar-open');
			}
		});

		// Close sidebar when clicking a link (mobile)
		if ($(window).width() < 992) {
			$('.zSidebar a:not([data-bs-toggle="collapse"])').on('click', function () {
				sidebar.removeClass('active');
				overlay.removeClass('active');
				$('body').removeClass('sidebar-open');
			});
		}
	});
</script>