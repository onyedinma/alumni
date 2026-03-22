<nav class="hp-navbar" id="navbar">
    <div class="hp-navbar__container">
        <!-- Logo -->
        <a href="{{ route('index') }}" class="hp-navbar__logo">
            <img src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}">
        </a>

        <!-- Desktop Navigation -->
        <div class="hp-navbar__menu">
            <a href="{{ route('index') }}"
                class="hp-navbar__link {{ request()->routeIs('index') ? 'hp-navbar__link--active' : '' }}">
                {{ __('Home') }}
            </a>
            <a href="{{ route('all.alumni') }}"
                class="hp-navbar__link {{ request()->routeIs('all.alumni') ? 'hp-navbar__link--active' : '' }}">
                {{ __('Alumni') }}
            </a>
            <a href="{{ route('excos') }}"
                class="hp-navbar__link {{ request()->routeIs('excos') ? 'hp-navbar__link--active' : '' }}">
                {{ __('Excos') }}
            </a>
            <a href="{{ route('our.history') }}"
                class="hp-navbar__link {{ request()->routeIs('our.history') ? 'hp-navbar__link--active' : '' }}">
                {{ __('Our History') }}
            </a>
            <a href="{{ route('all.event') }}"
                class="hp-navbar__link {{ request()->routeIs('all.event') ? 'hp-navbar__link--active' : '' }}">
                {{ __('Events') }}
            </a>
            <a href="{{ route('all.stories') }}"
                class="hp-navbar__link {{ request()->routeIs('all.stories') ? 'hp-navbar__link--active' : '' }}">
                {{ __('Stories') }}
            </a>
            <a href="{{ route('our.news') }}"
                class="hp-navbar__link {{ request()->routeIs('our.news') ? 'hp-navbar__link--active' : '' }}">
                {{ __('News') }}
            </a>
            <a href="{{ route('all.job') }}"
                class="hp-navbar__link {{ request()->routeIs('all.job') ? 'hp-navbar__link--active' : '' }}">
                {{ __('Jobs') }}
            </a>

            <!-- Donate Button -->
            <a href="{{ route('donation.index') }}" class="hp-navbar__btn hp-navbar__btn--outline">
                <i class="fa-solid fa-heart"></i>
                {{ __('Donate') }}
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="hp-navbar__btn hp-navbar__btn--primary">
                    <i class="fa-solid fa-gauge-high"></i>
                    {{ __('Dashboard') }}
                </a>
            @else
                <a href="{{ route('login') }}" class="hp-navbar__btn hp-navbar__btn--primary">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    {{ __('Login') }}
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="hp-navbar__toggle" id="navToggle" aria-label="Toggle navigation">
            <span class="hp-navbar__toggle-bar"></span>
            <span class="hp-navbar__toggle-bar"></span>
            <span class="hp-navbar__toggle-bar"></span>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="hp-navbar__mobile-menu" id="mobileMenu">
        <a href="{{ route('index') }}" class="hp-navbar__mobile-link">{{ __('Home') }}</a>
        <a href="{{ route('all.alumni') }}" class="hp-navbar__mobile-link">{{ __('Alumni') }}</a>
        <a href="{{ route('excos') }}" class="hp-navbar__mobile-link">{{ __('Excos') }}</a>
        <a href="{{ route('our.history') }}" class="hp-navbar__mobile-link">{{ __('Our History') }}</a>
        <a href="{{ route('all.event') }}" class="hp-navbar__mobile-link">{{ __('Events') }}</a>
        <a href="{{ route('all.stories') }}" class="hp-navbar__mobile-link">{{ __('Stories') }}</a>
        <a href="{{ route('our.news') }}" class="hp-navbar__mobile-link">{{ __('News') }}</a>
        <a href="{{ route('all.job') }}" class="hp-navbar__mobile-link">{{ __('Jobs') }}</a>
        <div class="hp-navbar__mobile-actions">
            <a href="{{ route('donation.index') }}" class="hp-navbar__btn hp-navbar__btn--outline">
                <i class="fa-solid fa-heart"></i>
                {{ __('Donate') }}
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="hp-navbar__btn hp-navbar__btn--primary">
                    {{ __('Dashboard') }}
                </a>
            @else
                <a href="{{ route('login') }}" class="hp-navbar__btn hp-navbar__btn--primary">
                    {{ __('Login') }}
                </a>
            @endauth
        </div>
    </div>
</nav>

<style>
    /* ====================================================
       REVOLUTIONARY NAVIGATION - Glassmorphic Design
       ==================================================== */
    .hp-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        /* Always show dark background for visibility on all pages */
        background: rgba(13, 13, 13, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(212, 175, 90, 0.2);
    }

    /* Scrolled state - Slightly different shadow */
    .hp-navbar.scrolled {
        background: rgba(13, 13, 13, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(212, 175, 90, 0.2);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
    }

    .hp-navbar__container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Logo */
    .hp-navbar__logo {
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    .hp-navbar__logo img {
        height: 48px;
        width: auto;
        transition: transform 0.3s ease;
    }

    .hp-navbar__logo:hover img {
        transform: scale(1.05);
    }

    /* Desktop Menu */
    .hp-navbar__menu {
        display: none;
        align-items: center;
        gap: 0.5rem;
    }

    @media (min-width: 992px) {
        .hp-navbar__menu {
            display: flex;
        }
    }

    /* Navigation Links */
    .hp-navbar__link {
        position: relative;
        padding: 0.75rem 1.25rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s ease;
        border-radius: 4px;
    }

    .hp-navbar__link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #D4AF5A, #751525);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .hp-navbar__link:hover {
        color: #D4AF5A;
    }

    .hp-navbar__link:hover::after {
        width: 60%;
    }

    .hp-navbar__link--active {
        color: #D4AF5A;
    }

    .hp-navbar__link--active::after {
        width: 60%;
    }

    /* Navigation Buttons */
    .hp-navbar__btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-family: 'Playfair Display', serif;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 4px;
        /* Sharp corners */
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    /* Shimmer effect */
    .hp-navbar__btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .hp-navbar__btn:hover::before {
        left: 100%;
    }

    .hp-navbar__btn--outline {
        background: transparent;
        color: #D4AF5A;
        border: 2px solid rgba(212, 175, 90, 0.5);
    }

    .hp-navbar__btn--outline:hover {
        background: rgba(212, 175, 90, 0.15);
        border-color: #D4AF5A;
        color: #D4AF5A;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
    }

    .hp-navbar__btn--primary {
        background: linear-gradient(135deg, #D4AF5A 0%, #B8934A 100%);
        color: #0D0D0D;
        border: none;
        box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
    }

    .hp-navbar__btn--primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(212, 175, 90, 0.4);
        color: #0D0D0D;
    }

    /* Mobile Toggle */
    .hp-navbar__toggle {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 28px;
        height: 20px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    @media (min-width: 992px) {
        .hp-navbar__toggle {
            display: none;
        }
    }

    .hp-navbar__toggle-bar {
        display: block;
        width: 100%;
        height: 3px;
        background: #D4AF5A;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .hp-navbar__toggle.active .hp-navbar__toggle-bar:nth-child(1) {
        transform: rotate(45deg) translate(5px, 6px);
    }

    .hp-navbar__toggle.active .hp-navbar__toggle-bar:nth-child(2) {
        opacity: 0;
    }

    .hp-navbar__toggle.active .hp-navbar__toggle-bar:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -6px);
    }

    /* Mobile Menu */
    .hp-navbar__mobile-menu {
        display: none;
        flex-direction: column;
        padding: 1rem 2rem 2rem;
        background: rgba(13, 13, 13, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-top: 1px solid rgba(212, 175, 90, 0.2);
    }

    .hp-navbar__mobile-menu.active {
        display: flex;
    }

    @media (min-width: 992px) {
        .hp-navbar__mobile-menu {
            display: none !important;
        }
    }

    .hp-navbar__mobile-link {
        padding: 1rem 0;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .hp-navbar__mobile-link:hover {
        color: #D4AF5A;
        padding-left: 0.5rem;
    }

    .hp-navbar__mobile-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .hp-navbar__mobile-actions .hp-navbar__btn {
        justify-content: center;
        width: 100%;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('navbar');
        const navToggle = document.getElementById('navToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        // Scroll effect
        function handleScroll() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Initial check

        // Mobile menu toggle
        navToggle.addEventListener('click', function () {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });

        // Close mobile menu on link click
        document.querySelectorAll('.hp-navbar__mobile-link').forEach(link => {
            link.addEventListener('click', function () {
                navToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
            });
        });
    });
</script>