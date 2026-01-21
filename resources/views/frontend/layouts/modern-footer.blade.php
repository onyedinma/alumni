<footer class="hp-footer">
    <div class="hp-footer__container">
        <div class="hp-footer__grid">
            <!-- Logo & Description -->
            <div class="hp-footer__brand">
                <img src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}" class="hp-footer__logo">
                <p class="hp-footer__desc">
                    {{ getOption('footer_description') ?? 'Connect with ex-students, share memories, and build your professional network.' }}
                </p>
            </div>

            <!-- Quick Links -->
            <div class="hp-footer__column">
                <h4 class="hp-footer__title">Quick Links</h4>
                <ul class="hp-footer__links">
                    <li><a href="{{ route('pages', 'about-us') }}">About Us</a></li>
                    <li><a href="{{ route('pages', 'constitution') }}">Constitution</a></li>
                    <li><a href="{{ route('all.event') }}">Events</a></li>
                    <li><a href="{{ route('all.stories') }}">Stories</a></li>
                    <li><a href="{{ route('contact_us') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Community -->
            <div class="hp-footer__column">
                <h4 class="hp-footer__title">Community</h4>
                <ul class="hp-footer__links">
                    <li><a href="{{ route('all.alumni') }}">Find Alumni</a></li>
                    <li><a href="{{ route('all.job') }}">Jobs</a></li>
                    <li><a href="{{ route('all.membership') }}">Membership</a></li>
                    <li><a href="{{ route('donation.index') }}">Donate</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="hp-footer__column">
                <h4 class="hp-footer__title">Newsletter</h4>
                <p class="hp-footer__newsletter-text">Stay updated with the latest news.</p>
                <div class="hp-footer__newsletter">
                    <input type="email" placeholder="Enter your email" class="hp-footer__input">
                    <button class="hp-footer__submit">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="hp-footer__bottom">
            <p class="hp-footer__copyright">© {{ date('Y') }} {{ getOption('app_name') }}. All rights reserved.</p>
            <div class="hp-footer__social">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

<style>
    /* ====================================================
       FOOTER - Slate Gray with Gold Accents
       ==================================================== */
    .hp-footer {
        background: #5D6875;
        /* Slate gray from image */
        color: #fff;
        position: relative;
        padding-top: 0;
    }

    /* Gold accent line at top */
    .hp-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #D4AF5A, #B8934A, #D4AF5A);
    }

    .hp-footer__container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 4rem 2rem 2rem;
    }

    .hp-footer__grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2.5rem;
        padding-bottom: 3rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    @media (min-width: 768px) {
        .hp-footer__grid {
            grid-template-columns: 1.5fr 1fr 1fr 1.5fr;
            gap: 3rem;
        }
    }

    /* Brand Section */
    .hp-footer__brand {
        max-width: 280px;
    }

    .hp-footer__logo {
        height: 50px;
        width: auto;
        margin-bottom: 1.25rem;
        opacity: 0.95;
    }

    .hp-footer__desc {
        font-size: 0.95rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.8);
    }

    /* Column Titles */
    .hp-footer__title {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: #D4AF5A;
        margin-bottom: 1.5rem;
        letter-spacing: 0.02em;
    }

    /* Links */
    .hp-footer__links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .hp-footer__links li {
        margin-bottom: 0.85rem;
    }

    .hp-footer__links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .hp-footer__links a:hover {
        color: #D4AF5A;
        padding-left: 5px;
    }

    /* Newsletter */
    .hp-footer__newsletter-text {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    .hp-footer__newsletter {
        display: flex;
    }

    .hp-footer__input {
        flex: 1;
        padding: 0.85rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-right: none;
        border-radius: 4px 0 0 4px;
        color: #fff;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.3s ease;
    }

    .hp-footer__input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .hp-footer__input:focus {
        border-color: rgba(212, 175, 90, 0.5);
        background: rgba(255, 255, 255, 0.15);
    }

    .hp-footer__submit {
        padding: 0.85rem 1.25rem;
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
    }

    /* Bottom Bar */
    .hp-footer__bottom {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        padding-top: 2rem;
        text-align: center;
    }

    @media (min-width: 768px) {
        .hp-footer__bottom {
            flex-direction: row;
            justify-content: space-between;
            text-align: left;
        }
    }

    .hp-footer__copyright {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .hp-footer__social {
        display: flex;
        gap: 1.25rem;
    }

    .hp-footer__social a {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .hp-footer__social a:hover {
        color: #D4AF5A;
        transform: translateY(-2px);
    }
</style>