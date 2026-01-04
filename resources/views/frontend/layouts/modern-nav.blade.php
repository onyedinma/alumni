<nav class="fixed w-full z-40 top-0 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('index') }}">
                    <img class="h-10 w-auto" src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}">
                </a>
            </div>
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('index') }}"
                    class="text-white hover:text-gold-400 transition-colors font-sans font-medium">Home</a>
                <a href="{{ route('all.alumni') }}"
                    class="text-white hover:text-gold-400 transition-colors font-sans font-medium">Alumni</a>
                <a href="{{ route('all.event') }}"
                    class="text-white hover:text-gold-400 transition-colors font-sans font-medium">Events</a>
                <a href="{{ route('all.stories') }}"
                    class="text-white hover:text-gold-400 transition-colors font-sans font-medium">Stories</a>
                <a href="{{ route('all.job') }}"
                    class="text-white hover:text-gold-400 transition-colors font-sans font-medium">Jobs</a>
                <a href="{{ route('donation.index') }}"
                    class="px-5 py-2 rounded-sm font-serif font-bold text-gold-400 border border-gold-500 hover:bg-gold-500 hover:text-white transition-all uppercase text-sm tracking-wider">Donate</a>

                @auth
                    <a href="{{ route('dashboard') }}"
                        class="bg-white text-maroon-900 px-6 py-2 rounded-sm font-serif font-bold hover:bg-gold-50 transition-all shadow-md border border-white hover:border-gold-200">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-gold-500 text-white px-6 py-2 rounded-sm font-serif font-bold hover:bg-gold-600 transition-all shadow-md">Login</a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button class="text-white hover:text-blue-200">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
<script>
    window.addEventListener('scroll', function () {
        const nav = document.getElementById('navbar');
        if (window.scrollY > 50) {
            nav.classList.add('bg-maroon-900/95', 'backdrop-blur-md', 'shadow-md', 'border-b', 'border-gold-500/30');
        } else {
            nav.classList.remove('bg-maroon-900/95', 'backdrop-blur-md', 'shadow-md', 'border-b', 'border-gold-500/30');
        }
    });
</script>