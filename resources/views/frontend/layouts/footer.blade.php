<!-- Start Footer -->
<style>
    .hp-footer {
        background: #5D6875;
        position: relative;
        padding: 0;
    }

    .hp-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #D4AF5A, #C4A04A, #D4AF5A);
    }

    .hp-footer__container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3.5rem 2rem 1.5rem;
    }

    .hp-footer__grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2.5rem;
        padding-bottom: 2.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    @media (min-width: 768px) {
        .hp-footer__grid {
            grid-template-columns: 1.4fr 1fr 1fr 1.4fr;
            gap: 2rem;
        }
    }

    /* Brand Section */
    .hp-footer__brand {
        max-width: 260px;
    }

    .hp-footer__logo {
        height: 45px;
        width: auto;
        margin-bottom: 1rem;
    }

    .hp-footer__desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        line-height: 1.65;
        color: rgba(255, 255, 255, 0.75);
    }

    /* Column Titles */
    .hp-footer__title {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        font-weight: 600;
        color: #D4AF5A;
        margin-bottom: 1.25rem;
        position: relative;
        display: inline-block;
    }

    .hp-footer__title::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 0;
        height: 1px;
        background: #D4AF5A;
        transition: width 0.4s ease;
    }

    .hp-footer__column:hover .hp-footer__title::after {
        width: 100%;
    }

    /* Links */
    .hp-footer__links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .hp-footer__links li {
        margin-bottom: 0.6rem;
    }

    .hp-footer__links a {
        font-family: 'Inter', sans-serif;
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        display: inline-block;
        padding: 2px 0;
    }

    .hp-footer__links a::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 1px;
        background: #D4AF5A;
        transition: width 0.3s ease;
    }

    .hp-footer__links a:hover {
        color: #D4AF5A;
        transform: translateX(5px);
    }

    .hp-footer__links a:hover::before {
        width: 100%;
    }

    /* Newsletter */
    .hp-footer__newsletter-text {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        color: rgba(255, 255, 255, 0.75);
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    .hp-footer__newsletter {
        display: flex;
    }

    .hp-footer__input {
        flex: 1;
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-right: none;
        border-radius: 4px 0 0 4px;
        color: #fff;
        font-size: 0.85rem;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: all 0.3s ease;
    }

    .hp-footer__input::placeholder {
        color: rgba(255, 255, 255, 0.45);
    }

    .hp-footer__input:focus {
        border-color: rgba(212, 175, 90, 0.4);
        background: rgba(255, 255, 255, 0.12);
    }

    .hp-footer__submit {
        padding: 0.75rem 1.1rem;
        background: #D4AF5A;
        border: none;
        border-radius: 0 4px 4px 0;
        color: #2D2D2D;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .hp-footer__submit:hover {
        background: #E3C16E;
        transform: scale(1.05);
    }

    .hp-footer__submit i {
        transition: transform 0.3s ease;
    }

    .hp-footer__submit:hover i {
        transform: translateX(2px);
    }

    /* Bottom Bar */
    .hp-footer__bottom {
        padding-top: 1.25rem;
        text-align: center;
    }

    .hp-footer__copyright {
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
    }
</style>

<footer class="hp-footer">
    <div class="hp-footer__container">
        <div class="hp-footer__grid">
            <!-- Brand -->
            <div class="hp-footer__brand">
                <img src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}" class="hp-footer__logo">
                <p class="hp-footer__desc">
                    {{ getOption('footer_description') ?? 'Connect with ex-students, share memories, and build your professional network.' }}
                </p>
            </div>

            <!-- Quick Links -->
            <div class="hp-footer__column">
                <h4 class="hp-footer__title">{{ __('Quick Links') }}</h4>
                <ul class="hp-footer__links">
                    <li><a href="{{ route('pages', 'about-us') }}">{{ __('About Us') }}</a></li>
                    <li><a href="{{ route('pages', 'constitution') }}">{{ __('Constitution') }}</a></li>
                    <li><a href="{{ route('all.event') }}">{{ __('Events') }}</a></li>
                    <li><a href="{{ route('all.stories') }}">{{ __('Stories') }}</a></li>
                    <li><a href="{{ route('contact_us') }}">{{ __('Contact') }}</a></li>
                </ul>
            </div>

            <!-- Community -->
            <div class="hp-footer__column">
                <h4 class="hp-footer__title">{{ __('Community') }}</h4>
                <ul class="hp-footer__links">
                    <li><a href="{{ route('all.alumni') }}">{{ __('Find Alumni') }}</a></li>
                    <li><a href="{{ route('all.job') }}">{{ __('Jobs') }}</a></li>
                    <li><a href="{{ route('all.membership') }}">{{ __('Membership') }}</a></li>
                    <li><a href="{{ route('donation.index') }}">{{ __('Donate') }}</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="hp-footer__column">
                <h4 class="hp-footer__title">{{ __('Newsletter') }}</h4>
                <p class="hp-footer__newsletter-text">{{ __('Stay updated with the latest news.') }}</p>
                <div class="hp-footer__newsletter">
                    <input type="email" placeholder="{{ __('Enter your email') }}" class="hp-footer__input">
                    <button class="hp-footer__submit">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Bottom -->
        <div class="hp-footer__bottom">
            <p class="hp-footer__copyright">© {{ date('Y') }} {{ getOption('app_name') }}.
                {{ __('All rights reserved.') }}</p>
        </div>
    </div>
</footer>
<!-- End Footer -->