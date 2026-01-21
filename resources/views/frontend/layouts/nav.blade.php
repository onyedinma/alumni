<!-- Start Header -->
<style>
    .hp-header {
        background: linear-gradient(135deg, #2D1A1A 0%, #1A0F0F 100%);
        padding: 0;
        border-bottom: 1px solid rgba(212, 175, 90, 0.2);
    }

    .hp-header__container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 70px;
    }

    .hp-header__logo {
        flex-shrink: 0;
    }

    .hp-header__logo img {
        height: 50px;
        width: auto;
    }

    .hp-header__nav {
        display: none;
        align-items: center;
        gap: 0.25rem;
    }

    @media (min-width: 992px) {
        .hp-header__nav {
            display: flex;
        }
    }

    .hp-header__link {
        padding: 0.65rem 1.1rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        transition: all 0.3s ease;
        position: relative;
    }

    /* Gradient line animation on hover */
    .hp-header__link::after {
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

    .hp-header__link:hover {
        color: #D4AF5A;
    }

    .hp-header__link:hover::after {
        width: 60%;
    }

    .hp-header__link--active {
        color: #D4AF5A;
    }

    .hp-header__link--active::after {
        width: 60%;
    }

    .hp-header__actions {
        display: none;
        align-items: center;
        gap: 0.75rem;
    }

    @media (min-width: 992px) {
        .hp-header__actions {
            display: flex;
        }
    }

    .hp-header__btn {
        padding: 0.6rem 1.5rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        font-weight: 700;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .hp-header__btn--outline {
        background: transparent;
        color: #D4AF5A;
        border: 1.5px solid #D4AF5A;
    }

    .hp-header__btn--outline:hover {
        background: rgba(212, 175, 90, 0.15);
        color: #D4AF5A;
    }

    .hp-header__btn--primary {
        background: linear-gradient(135deg, #D4AF5A 0%, #B8934A 100%);
        color: #1A0F0F;
        border: 1.5px solid #D4AF5A;
    }

    .hp-header__btn--primary:hover {
        background: linear-gradient(135deg, #E3C16E 0%, #D4AF5A 100%);
        color: #1A0F0F;
    }

    /* Mobile Toggle */
    .hp-header__toggle {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 26px;
        height: 18px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    @media (min-width: 992px) {
        .hp-header__toggle {
            display: none;
        }
    }

    .hp-header__toggle-bar {
        display: block;
        width: 100%;
        height: 2px;
        background: #D4AF5A;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .hp-header__toggle.active .hp-header__toggle-bar:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .hp-header__toggle.active .hp-header__toggle-bar:nth-child(2) {
        opacity: 0;
    }

    .hp-header__toggle.active .hp-header__toggle-bar:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px);
    }

    /* Mobile Menu */
    .hp-header__mobile {
        display: none;
        flex-direction: column;
        padding: 1.5rem 2rem 2rem;
        background: linear-gradient(135deg, #2D1A1A 0%, #1A0F0F 100%);
        border-top: 1px solid rgba(212, 175, 90, 0.15);
    }

    .hp-header__mobile.active {
        display: flex;
    }

    @media (min-width: 992px) {
        .hp-header__mobile {
            display: none !important;
        }
    }

    .hp-header__mobile-link {
        padding: 0.85rem 0;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        transition: all 0.3s ease;
    }

    .hp-header__mobile-link:hover {
        color: #D4AF5A;
        padding-left: 0.5rem;
    }

    .hp-header__mobile-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1.25rem;
    }

    .hp-header__mobile-actions .hp-header__btn {
        text-align: center;
        justify-content: center;
    }
</style>

<header class="hp-header" id="mainHeader">
    <div class="hp-header__container">
        <!-- Logo -->
        <a href="{{ route('index') }}" class="hp-header__logo">
            <img src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}">
        </a>

        <!-- Desktop Navigation -->
        <nav class="hp-header__nav">
            <a href="{{ route('index') }}"
                class="hp-header__link {{ request()->routeIs('index') ? 'hp-header__link--active' : '' }}">{{ __('Home') }}</a>
            <a href="{{ route('all.alumni') }}"
                class="hp-header__link {{ request()->routeIs('all.alumni') ? 'hp-header__link--active' : '' }}">{{ __('Alumni') }}</a>
            <a href="{{ route('all.event') }}"
                class="hp-header__link {{ request()->routeIs('all.event') ? 'hp-header__link--active' : '' }}">{{ __('Events') }}</a>
            <a href="{{ route('all.stories') }}"
                class="hp-header__link {{ request()->routeIs('all.stories') ? 'hp-header__link--active' : '' }}">{{ __('Stories') }}</a>
            <a href="{{ route('our.news') }}"
                class="hp-header__link {{ request()->routeIs('our.news') ? 'hp-header__link--active' : '' }}">{{ __('News') }}</a>
            <a href="{{ route('all.job') }}"
                class="hp-header__link {{ request()->routeIs('all.job') ? 'hp-header__link--active' : '' }}">{{ __('Jobs') }}</a>
        </nav>

        <!-- Action Buttons -->
        <div class="hp-header__actions">
            <a href="{{ route('donation.index') }}"
                class="hp-header__btn hp-header__btn--outline">{{ __('Donate') }}</a>
            @auth
                <a href="{{ route('dashboard') }}" class="hp-header__btn hp-header__btn--primary">{{ __('Dashboard') }}</a>
            @else
                <a href="{{ route('login') }}" class="hp-header__btn hp-header__btn--primary">{{ __('Login') }}</a>
            @endauth
        </div>

        <!-- Mobile Toggle -->
        <button class="hp-header__toggle" id="headerToggle" aria-label="Toggle navigation">
            <span class="hp-header__toggle-bar"></span>
            <span class="hp-header__toggle-bar"></span>
            <span class="hp-header__toggle-bar"></span>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="hp-header__mobile" id="headerMobile">
        <a href="{{ route('index') }}" class="hp-header__mobile-link">{{ __('Home') }}</a>
        <a href="{{ route('all.alumni') }}" class="hp-header__mobile-link">{{ __('Alumni') }}</a>
        <a href="{{ route('all.event') }}" class="hp-header__mobile-link">{{ __('Events') }}</a>
        <a href="{{ route('all.stories') }}" class="hp-header__mobile-link">{{ __('Stories') }}</a>
        <a href="{{ route('our.news') }}" class="hp-header__mobile-link">{{ __('News') }}</a>
        <a href="{{ route('all.job') }}" class="hp-header__mobile-link">{{ __('Jobs') }}</a>
        <div class="hp-header__mobile-actions">
            <a href="{{ route('donation.index') }}"
                class="hp-header__btn hp-header__btn--outline">{{ __('Donate') }}</a>
            @auth
                <a href="{{ route('dashboard') }}" class="hp-header__btn hp-header__btn--primary">{{ __('Dashboard') }}</a>
            @else
                <a href="{{ route('login') }}" class="hp-header__btn hp-header__btn--primary">{{ __('Login') }}</a>
            @endauth
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('headerToggle');
        const mobile = document.getElementById('headerMobile');

        if (toggle && mobile) {
            toggle.addEventListener('click', function () {
                this.classList.toggle('active');
                mobile.classList.toggle('active');
            });

            // Close on link click
            document.querySelectorAll('.hp-header__mobile-link').forEach(link => {
                link.addEventListener('click', function () {
                    toggle.classList.remove('active');
                    mobile.classList.remove('active');
                });
            });
        }
    });
</script>
<!-- End Header -->