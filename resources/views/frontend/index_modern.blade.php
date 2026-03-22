@extends('frontend.layouts.app')

@push('title')
    {{ __('Home') }}
@endpush

@section('content')
    <style>
        /* ====================================================
                                                                                                                                                   REVOLUTIONARY HOMEPAGE DESIGN SYSTEM
                                                                                                                                                   Philosophy: "Ethereal Elegance" - Unprecedented visual experience
                                                                                                                                                   ====================================================  */

        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap');

        /* -- Revolutionary Design Tokens -- */
        :root {
            /* Primary Palette - Enhanced Royal Deep Mode */
            --hp-maroon: #6B1326; /* Deeper, richer Bordeaux */
            --hp-maroon-light: #8A1A33;
            --hp-maroon-dark: #450A17;
            --hp-maroon-glow: rgba(107, 19, 38, 0.6);
            --hp-gold: #D4AF37; /* Authentic Premium Gold */
            --hp-gold-light: #F3E5AB;
            --hp-gold-dark: #AA8C2C;
            --hp-gold-glow: rgba(212, 175, 55, 0.45);

            /* Obsidian Dark Mode - Deeper Contrast */
            --hp-obsidian: #050505;
            --hp-charcoal: #0F0F1A;
            --hp-slate: #1A1A2E;
            --hp-smoke: rgba(255, 255, 255, 0.05);

            /* Neutrals */
            --hp-ivory: #FDFBFA;
            --hp-cream: #FAF7F2;
            --hp-gray-100: #F4F6F8;
            --hp-gray-200: #E2E8F0;
            --hp-gray-500: #64748B;
            --hp-gray-800: #1E293B;

            /* Revolutionary Shadows - Volumetric and Soft */
            --shadow-sm: 0 4px 10px -1px rgba(0, 0, 0, 0.08), 0 2px 5px -1px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 12px 20px -3px rgba(0, 0, 0, 0.12), 0 6px 12px -2px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 24px 40px -8px rgba(0, 0, 0, 0.15), 0 12px 20px -5px rgba(0, 0, 0, 0.08);
            --shadow-gold: 0 12px 35px rgba(212, 175, 55, 0.25);
            --shadow-gold-intense: 0 0 60px rgba(212, 175, 55, 0.4);
            --shadow-maroon: 0 15px 40px rgba(107, 19, 38, 0.3);
            --shadow-3d: 0 40px 70px -15px rgba(0, 0, 0, 0.5);
            --shadow-glass: 0 10px 40px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.15);

            /* Glassmorphism */
            --glass-bg: rgba(255, 255, 255, 0.04);
            --glass-bg-light: rgba(255, 255, 255, 0.92);
            --glass-border: rgba(212, 175, 55, 0.35);
            --glass-blur: blur(30px);

            /* Transitions */
            --transition-fast: 0.15s ease;
            --transition-normal: 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            --transition-slow: 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            --transition-bounce: 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            --transition-magnetic: 0.5s cubic-bezier(0.23, 1, 0.32, 1);

            /* Aurora Effect Colors - More harmonic */
            --aurora-1: rgba(107, 19, 38, 0.4);
            --aurora-2: rgba(212, 175, 55, 0.3);
            --aurora-3: rgba(15, 15, 26, 0.95);
        }

        /* -- Typography -- */
        .hp-font-display {
            font-family: 'Playfair Display', Georgia, serif;
        }

        .hp-font-body, body, p, span, div, a {
            font-family: 'Outfit', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* -- Utility Classes -- */
        .hp-text-maroon {
            color: var(--hp-maroon);
        }

        .hp-text-gold {
            color: var(--hp-gold);
        }

        .hp-text-charcoal {
            color: var(--hp-charcoal);
        }

        .hp-text-muted {
            color: var(--hp-gray-500);
        }

        .hp-bg-maroon {
            background-color: var(--hp-maroon);
        }

        .hp-bg-gold {
            background-color: var(--hp-gold);
        }

        .hp-bg-cream {
            background-color: var(--hp-cream);
        }

        .hp-bg-charcoal {
            background-color: var(--hp-charcoal);
        }

        /* ====================================================
                                                                                                                                                   REVOLUTIONARY ANIMATIONS
                                                                                                                                                   ==================================================== */

        /* Aurora Borealis Effect */
        @keyframes auroraShift {

            0%,
            100% {
                background-position: 0% 50%;
                opacity: 0.6;
            }

            25% {
                background-position: 50% 100%;
                opacity: 0.8;
            }

            50% {
                background-position: 100% 50%;
                opacity: 0.5;
            }

            75% {
                background-position: 50% 0%;
                opacity: 0.7;
            }
        }

        @keyframes floatParticle {

            0%,
            100% {
                transform: translateY(0) translateX(0) scale(1);
                opacity: 0.3;
            }

            25% {
                transform: translateY(-30px) translateX(10px) scale(1.1);
                opacity: 0.6;
            }

            50% {
                transform: translateY(-15px) translateX(-10px) scale(0.9);
                opacity: 0.4;
            }

            75% {
                transform: translateY(-40px) translateX(5px) scale(1.05);
                opacity: 0.5;
            }
        }

        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 0 20px var(--hp-gold-glow);
            }

            50% {
                box-shadow: 0 0 40px var(--hp-gold-glow), 0 0 60px rgba(212, 175, 90, 0.3);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        @keyframes morphBlob {

            0%,
            100% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            }

            25% {
                border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
            }

            50% {
                border-radius: 50% 60% 40% 70% / 40% 50% 60% 50%;
            }

            75% {
                border-radius: 40% 50% 60% 40% / 60% 40% 50% 70%;
            }
        }

        @keyframes magneticPull {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(var(--magnetic-x, 0), var(--magnetic-y, 0));
            }
        }

        @keyframes revealFromBottom {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes holographicSheen {
            0% {
                background-position: -100% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        /* ====================================================
                                                                                                                                                   GLASSMORPHISM COMPONENTS
                                                                                                                                                   ==================================================== */
        .hp-glass {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-glass);
        }

        .hp-glass-light {
            background: var(--glass-bg-light);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid rgba(212, 175, 90, 0.15);
        }

        .hp-glass:hover {
            border-color: rgba(212, 175, 90, 0.4);
            box-shadow: var(--shadow-glass), 0 0 30px rgba(212, 175, 90, 0.15);
        }

        /* ====================================================
                                                                                                                                                   3D TILT CARD SYSTEM
                                                                                                                                                   ==================================================== */
        .hp-tilt-card {
            transform-style: preserve-3d;
            transition: transform var(--transition-slow);
            will-change: transform;
        }

        .hp-tilt-card:hover {
            transform: perspective(1000px) rotateX(var(--tilt-x, 0deg)) rotateY(var(--tilt-y, 0deg));
        }

        .hp-tilt-card__inner {
            transform: translateZ(20px);
            transition: transform var(--transition-normal);
        }

        .hp-tilt-card:hover .hp-tilt-card__inner {
            transform: translateZ(40px);
        }

        /* ====================================================
                                                                                                                                                   MAGNETIC BUTTON EFFECT
                                                                                                                                                   ==================================================== */
        .hp-magnetic {
            position: relative;
            transition: transform var(--transition-magnetic);
        }

        .hp-magnetic:hover {
            transform: translate(var(--magnetic-x, 0), var(--magnetic-y, 0));
        }

        .hp-magnetic::before {
            content: '';
            position: absolute;
            inset: -10px;
            border-radius: inherit;
            background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(212, 175, 90, 0.3), transparent 60%);
            opacity: 0;
            transition: opacity var(--transition-normal);
            pointer-events: none;
        }

        .hp-magnetic:hover::before {
            opacity: 1;
        }

        /* ====================================================
                                                                                                                                                   HOLOGRAPHIC OVERLAY
                                                                                                                                                   ==================================================== */
        .hp-holographic {
            position: relative;
            overflow: hidden;
        }

        .hp-holographic::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg,
                    transparent 40%,
                    rgba(212, 175, 90, 0.3) 45%,
                    rgba(117, 21, 37, 0.2) 50%,
                    transparent 55%);
            background-size: 200% 100%;
            opacity: 0;
            transition: opacity var(--transition-normal);
            pointer-events: none;
        }

        .hp-holographic:hover::after {
            opacity: 1;
            animation: holographicSheen 1.5s ease forwards;
        }

        /* ====================================================
                                                                                                                                                   PARTICLE SYSTEM (CSS)
                                                                                                                                                   ==================================================== */
        .hp-particles {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .hp-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--hp-gold);
            border-radius: 50%;
            animation: floatParticle 8s ease-in-out infinite;
        }

        .hp-particle:nth-child(1) {
            left: 10%;
            top: 20%;
            animation-delay: 0s;
        }

        .hp-particle:nth-child(2) {
            left: 20%;
            top: 80%;
            animation-delay: 1s;
        }

        .hp-particle:nth-child(3) {
            left: 30%;
            top: 40%;
            animation-delay: 2s;
        }

        .hp-particle:nth-child(4) {
            left: 50%;
            top: 60%;
            animation-delay: 3s;
        }

        .hp-particle:nth-child(5) {
            left: 70%;
            top: 30%;
            animation-delay: 4s;
        }

        .hp-particle:nth-child(6) {
            left: 80%;
            top: 70%;
            animation-delay: 5s;
        }

        .hp-particle:nth-child(7) {
            left: 90%;
            top: 50%;
            animation-delay: 6s;
        }

        .hp-particle:nth-child(8) {
            left: 15%;
            top: 90%;
            animation-delay: 7s;
        }

        /* ====================================================
                                                                                                                                                   SHARP CORNER STYLING (NEWS SECTION STYLE)
                                                                                                                                                   ==================================================== */
        .hp-sharp {
            border-radius: 4px !important;
        }

        .hp-badge--gold {
            display: inline-block;
            background: var(--hp-gold);
            color: var(--hp-charcoal);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0.5rem 1rem;
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(212, 175, 90, 0.3);
        }

        .hp-link--editorial {
            color: var(--hp-maroon);
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all var(--transition-fast);
        }

        .hp-link--editorial:hover {
            color: var(--hp-maroon-dark);
            gap: 0.75rem;
        }

        .hp-link--editorial i {
            transition: transform var(--transition-fast);
        }

        .hp-link--editorial:hover i {
            transform: translateX(4px);
        }

        /* ====================================================
                                                                                                                                                   HERO SECTION - Revolutionary Aurora Experience
                                                                                                                                                   ==================================================== */
        .hp-hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: var(--hp-obsidian);
        }

        .hp-hero__bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0.3;
            transition: transform 20s linear;
            filter: saturate(0.8);
        }

        /* Aurora Borealis Animated Overlay */
        .hp-hero__aurora {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    var(--aurora-3) 0%,
                    var(--aurora-1) 25%,
                    var(--aurora-2) 50%,
                    var(--aurora-1) 75%,
                    var(--aurora-3) 100%);
            background-size: 400% 400%;
            animation: auroraShift 15s ease infinite;
            opacity: 0.9;
        }

        .hp-hero__overlay {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 0%,
                    transparent 0%,
                    rgba(13, 13, 13, 0.4) 50%,
                    rgba(13, 13, 13, 0.8) 100%);
        }

        /* Vignette Effect */
        .hp-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 50%,
                    transparent 30%,
                    rgba(0, 0, 0, 0.5) 100%);
            z-index: 2;
            pointer-events: none;
        }

        .hp-hero__content {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 2rem;
            max-width: 950px;
        }

        /* Glassmorphic Badge */
        .hp-hero__badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.75rem;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 90, 0.4);
            border-radius: 4px;
            /* Sharp corners like news section */
            color: var(--hp-gold);
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.25em;
            margin-bottom: 2.5rem;
            box-shadow: 0 0 40px rgba(212, 175, 55, 0.25);
            animation: pulseGlow 4s ease-in-out infinite;
        }

        /* 3D Floating Title */
        .hp-hero__title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.01em;
            text-shadow:
                0 1px 0 rgba(0, 0, 0, 0.3),
                0 2px 0 rgba(0, 0, 0, 0.25),
                0 4px 0 rgba(0, 0, 0, 0.2),
                0 8px 16px rgba(0, 0, 0, 0.4),
                0 16px 32px rgba(0, 0, 0, 0.5);
            transform-style: preserve-3d;
        }

        .hp-hero__title em {
            font-style: italic;
            color: var(--hp-gold);
            text-shadow:
                0 0 25px var(--hp-gold-glow),
                0 0 50px rgba(212, 175, 55, 0.4);
        }

        .hp-hero__subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.8;
            max-width: 680px;
            margin: 0 auto 3rem !important;
            margin-left: auto !important;
            margin-right: auto !important;
            font-weight: 300;
            letter-spacing: 0.02em;
            text-align: center;
        }

        .hp-hero__actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1.25rem;
            justify-content: center;
        }

        /* Scroll Indicator */
        .hp-hero__scroll {
            position: absolute;
            bottom: 3rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: color var(--transition-normal);
        }

        .hp-hero__scroll:hover {
            color: var(--hp-gold);
        }

        .hp-hero__scroll-text {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
        }

        .hp-hero__scroll-mouse {
            width: 24px;
            height: 38px;
            border: 2px solid currentColor;
            border-radius: 12px;
            position: relative;
        }

        .hp-hero__scroll-mouse::before {
            content: '';
            position: absolute;
            top: 6px;
            left: 50%;
            transform: translateX(-50%);
            width: 3px;
            height: 6px;
            background: currentColor;
            border-radius: 3px;
            animation: scrollPulse 2s infinite;
        }

        @keyframes scrollPulse {

            0%,
            100% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            50% {
                opacity: 0.4;
                transform: translateX(-50%) translateY(12px);
            }
        }

        /* ====================================================
                                                                                                                                                   BUTTONS - Revolutionary Magnetic Elements
                                                                                                                                                   ==================================================== */
        .hp-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2.25rem;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            border-radius: 4px;
            /* Sharp corners like news section */
            transition: all var(--transition-normal);
            cursor: pointer;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.05em;
        }

        /* Shimmer effect overlay */
        .hp-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            transition: left 0.5s ease;
        }

        .hp-btn:hover::before {
            left: 100%;
        }

        .hp-btn--primary {
            background: linear-gradient(135deg, var(--hp-gold) 0%, #E6C252 50%, var(--hp-gold-dark) 100%);
            color: var(--hp-charcoal) !important;
            border-color: var(--hp-gold);
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.35);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.95rem;
            font-family: 'Outfit', sans-serif !important;
        }

        .hp-btn--primary:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: var(--shadow-gold-intense);
            color: #000 !important;
        }

        .hp-btn--outline {
            background: rgba(212, 175, 55, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: var(--hp-gold) !important;
            border-color: var(--hp-gold);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.95rem;
            font-family: 'Outfit', sans-serif !important;
        }

        .hp-btn--outline:hover {
            background: rgba(212, 175, 55, 0.15);
            border-color: var(--hp-gold-light);
            color: var(--hp-gold-light) !important;
            transform: translateY(-5px);
            box-shadow: 0 0 40px rgba(212, 175, 55, 0.25);
        }

        .hp-btn--maroon {
            background: linear-gradient(135deg, var(--hp-maroon) 0%, var(--hp-maroon-light) 100%);
            color: #fff !important;
            border-color: var(--hp-maroon);
            box-shadow: 0 4px 20px rgba(107, 19, 38, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.95rem;
            font-family: 'Outfit', sans-serif !important;
        }

        .hp-btn--maroon:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 10px 40px rgba(107, 19, 38, 0.5);
            color: #fff !important;
        }

        /* ====================================================
                                                                                                                                                   SECTION BASE STYLES
                                                                                                                                                   ==================================================== */
        .hp-section {
            padding: 6rem 0;
            position: relative;
        }

        .hp-section--dark {
            background: var(--hp-charcoal);
            color: #fff;
        }

        .hp-section--cream {
            background: var(--hp-cream);
        }

        .hp-section__header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .hp-section__badge {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            background: rgba(212, 175, 90, 0.12);
            color: var(--hp-gold);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            border-radius: 50px;
            margin-bottom: 1rem;
        }

        .hp-section--dark .hp-section__badge {
            background: rgba(212, 175, 90, 0.2);
        }

        .hp-section__title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            color: var(--hp-charcoal);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hp-section--dark .hp-section__title {
            color: #fff;
        }

        .hp-section__desc {
            font-size: 1.125rem;
            color: var(--hp-gray-500) !important;
            max-width: 600px;
            margin: 0 auto !important;
            margin-left: auto !important;
            margin-right: auto !important;
            line-height: 1.7;
            text-align: center;
        }

        /* Force color on CMS content that may have inline styles */
        .hp-section__desc *,
        .hp-section__desc p,
        .hp-section__desc span,
        .hp-section__desc div {
            color: #6C757D !important;
        }

        .hp-section--dark .hp-section__desc {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .hp-section--dark .hp-section__desc *,
        .hp-section--dark .hp-section__desc p,
        .hp-section--dark .hp-section__desc span,
        .hp-section--dark .hp-section__desc div {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        /* ====================================================
                                                                                                                                                   BENEFITS SECTION - Glassmorphic 3D Cards
                                                                                                                                                   ==================================================== */
        .hp-benefit-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            padding: 3rem 2rem;
            border-radius: 12px;
            /* Sharp corners */
            text-align: center;
            height: 100%;
            border: 1px solid rgba(212, 175, 55, 0.25);
            transition: all var(--transition-slow);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            box-shadow: var(--shadow-md);
        }

        /* Gradient border glow effect */
        .hp-benefit-card::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, var(--hp-maroon), var(--hp-gold), var(--hp-maroon));
            border-radius: 14px;
            z-index: -1;
            opacity: 0;
            transition: opacity var(--transition-normal);
        }

        /* Top accent line */
        .hp-benefit-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--hp-maroon), var(--hp-gold));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform var(--transition-normal);
        }

        .hp-benefit-card:hover {
            transform: translateY(-15px) perspective(1000px) rotateX(4deg) rotateY(-2deg);
            box-shadow: var(--shadow-3d), 0 0 50px rgba(212, 175, 55, 0.2);
            border-color: transparent;
        }

        .hp-benefit-card:hover::before {
            opacity: 0.3;
        }

        .hp-benefit-card:hover::after {
            transform: scaleX(1);
        }

        .hp-benefit-card__icon {
            width: 160px;
            height: 160px;
            margin: 0 auto 1.75rem;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.15), rgba(117, 21, 37, 0.08));
            border-radius: 8px;
            /* Sharp corners */
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-slow);
            position: relative;
            overflow: hidden;
        }

        /* Morphing blob background for icon */
        .hp-benefit-card__icon::before {
            content: '';
            position: absolute;
            inset: 10%;
            background: linear-gradient(135deg, var(--hp-gold), var(--hp-maroon));
            opacity: 0;
            animation: morphBlob 8s ease-in-out infinite;
            transition: opacity var(--transition-normal);
        }

        .hp-benefit-card:hover .hp-benefit-card__icon {
            background: linear-gradient(135deg, var(--hp-gold), var(--hp-gold-dark));
            transform: scale(1.35) rotate(-3deg);
            box-shadow: 0 12px 32px rgba(212, 175, 90, 0.5);
        }

        .hp-benefit-card:hover .hp-benefit-card__icon::before {
            opacity: 0.3;
        }

        .hp-benefit-card__icon img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            transition: all var(--transition-normal);
            position: relative;
            z-index: 1;
        }

        .hp-benefit-card:hover .hp-benefit-card__icon img {
            transform: scale(1.25);
        }

        .hp-benefit-card__title {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--hp-charcoal);
            margin-bottom: 1rem;
            transition: color var(--transition-normal);
        }

        .hp-benefit-card:hover .hp-benefit-card__title {
            color: var(--hp-maroon);
        }

        .hp-benefit-card__text {
            color: var(--hp-gray-500) !important;
            line-height: 1.8;
            font-size: 0.95rem;
        }

        /* Force color on CMS content that may have inline styles */
        .hp-benefit-card__text,
        .hp-benefit-card__text *,
        .hp-benefit-card__text p,
        .hp-benefit-card__text span,
        .hp-benefit-card__text div {
            color: #6C757D !important;
        }

        /* ====================================================
                                                                                                                                                   ABOUT SECTION - Two Column Layout
                                                                                                                                                   ==================================================== */
        .hp-about__image-wrap {
            position: relative;
        }

        .hp-about__image {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-lg), 0 0 30px rgba(212, 175, 90, 0.3);
            position: relative;
            padding: 5px;
            background: linear-gradient(135deg, #D4AF5A 0%, #751525 50%, #D4AF5A 100%);
        }

        .hp-about__image img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 20px;
            display: block;
        }

        .hp-about__stat-card {
            position: absolute;
            bottom: -2rem;
            right: -2rem;
            background: #fff;
            padding: 1.5rem 2rem;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            text-align: center;
            border-left: 4px solid var(--hp-gold);
        }

        .hp-about__stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            color: var(--hp-maroon);
            line-height: 1;
        }

        .hp-about__stat-label {
            color: var(--hp-gray-500);
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        .hp-about__content {
            padding-left: 3rem;
        }

        .hp-about__quote {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-style: italic;
            color: var(--hp-charcoal);
            line-height: 1.6;
            margin: 2rem 0;
            padding-left: 1.5rem;
            border-left: 3px solid var(--hp-gold);
        }

        /* ====================================================
                                                                                                                                                   STATS SECTION - Liquid Gradient with Morphing Blobs
                                                                                                                                                   ==================================================== */
        .hp-stats {
            background: linear-gradient(135deg, var(--hp-obsidian) 0%, var(--hp-charcoal) 50%, var(--hp-slate) 100%);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        /* Aurora gradient overlay */
        .hp-stats::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg,
                    transparent 0%,
                    rgba(117, 21, 37, 0.1) 25%,
                    rgba(212, 175, 90, 0.08) 50%,
                    rgba(117, 21, 37, 0.1) 75%,
                    transparent 100%);
            background-size: 400% 400%;
            animation: auroraShift 20s ease infinite;
        }

        /* Morphing blob decorations */
        .hp-stats::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(212, 175, 90, 0.1) 0%, transparent 70%);
            animation: morphBlob 15s ease-in-out infinite;
        }

        .hp-stat-item {
            text-align: center;
            padding: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .hp-stat-item__icon {
            font-size: 2.75rem;
            color: var(--hp-gold);
            margin-bottom: 1.25rem;
            text-shadow: 0 0 20px var(--hp-gold-glow);
            transition: all var(--transition-normal);
        }

        .hp-stat-item:hover .hp-stat-item__icon {
            transform: scale(1.1);
            text-shadow: 0 0 40px var(--hp-gold-glow);
        }

        .hp-stat-item__number {
            font-family: 'Playfair Display', serif;
            font-size: 4.5rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
            margin-bottom: 0.75rem;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.3);
            transition: all var(--transition-normal);
        }

        .hp-stat-item:hover .hp-stat-item__number {
            text-shadow: 0 0 50px rgba(212, 175, 90, 0.5);
        }

        .hp-stat-item__label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-weight: 600;
        }

        /* ====================================================
                                                                                                                                                   EVENT CARDS
                                                                                                                                                   - Holographic Sharp Design
                                                                                                                                                   ==================================================== */
        .hp-event-card {
            background: #fff;
            border-radius: 8px;
            /* Sharp corners */
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-slow);
            height: 100%;
            border: 1px solid rgba(212, 175, 90, 0.1);
            position: relative;
        }

        /* Holographic sheen overlay */
        .hp-event-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg,
                    transparent 40%,
                    rgba(212, 175, 90, 0.15) 45%,
                    rgba(117, 21, 37, 0.1) 50%,
                    transparent 55%);
            background-size: 200% 100%;
            opacity: 0;
            transition: opacity var(--transition-normal);
            pointer-events: none;
            z-index: 2;
        }

        .hp-event-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-3d);
            border-color: rgba(212, 175, 90, 0.3);
        }

        .hp-event-card:hover::after {
            opacity: 1;
            animation: holographicSheen 1.5s ease forwards;
        }

        .hp-event-card__image {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .hp-event-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-slow);
        }

        .hp-event-card:hover .hp-event-card__image img {
            transform: scale(1.1);
        }

        .hp-event-card__date {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--hp-gold);
            padding: 0.75rem 1rem;
            border-radius: 4px;
            /* Sharp corners */
            text-align: center;
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.4);
        }

        .hp-event-card__date-day {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--hp-charcoal);
            line-height: 1;
        }

        .hp-event-card__date-month {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: var(--hp-charcoal);
            letter-spacing: 0.1em;
            font-weight: 600;
        }

        .hp-event-card__body {
            padding: 1.75rem;
        }

        .hp-event-card__meta {
            display: flex;
            gap: 1rem;
            font-size: 0.85rem;
            color: var(--hp-gray-500);
            margin-bottom: 1rem;
        }

        .hp-event-card__meta i {
            color: var(--hp-gold);
        }

        .hp-event-card__title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--hp-charcoal);
            margin-bottom: 1rem;
            line-height: 1.35;
        }

        .hp-event-card__title a {
            color: inherit;
            text-decoration: none;
            transition: color var(--transition-fast);
        }

        .hp-event-card__title a:hover {
            color: var(--hp-maroon);
        }

        /* ====================================================
                                                                                                                                                   STORY CARDS - Sharp Editorial Design
                                                                                                                                                   ==================================================== */
        .hp-story-card {
            background: #fff;
            border-radius: 8px;
            /* Sharp corners */
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-slow);
            height: 100%;
            border: 1px solid rgba(212, 175, 90, 0.1);
            position: relative;
        }

        .hp-story-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--hp-maroon), var(--hp-gold));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform var(--transition-normal);
            z-index: 2;
        }

        .hp-story-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-3d);
            border-color: rgba(212, 175, 90, 0.3);
        }

        .hp-story-card:hover::before {
            transform: scaleX(1);
        }

        .hp-story-card__image {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .hp-story-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-slow);
        }

        .hp-story-card:hover .hp-story-card__image img {
            transform: scale(1.1);
        }

        .hp-story-card__body {
            padding: 1.75rem;
        }

        .hp-story-card__date {
            display: inline-block;
            background: var(--hp-gold);
            color: var(--hp-charcoal);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0.35rem 0.75rem;
            border-radius: 2px;
            margin-bottom: 1rem;
        }

        .hp-story-card__title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--hp-charcoal);
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .hp-story-card__title a {
            color: inherit;
            text-decoration: none;
            transition: color var(--transition-fast);
        }

        .hp-story-card__title a:hover {
            color: var(--hp-maroon);
        }

        /* ====================================================
                                                                                                                                                   ALUMNI CARDS - Ultramodern Premium Design
                                                                                                                                                   ==================================================== */
        .hp-alumni-section {
            background: linear-gradient(135deg, #1A0F0F 0%, #2D1A1A 50%, #1A0F0F 100%);
            position: relative;
            overflow: hidden;
        }

        .hp-alumni-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(ellipse at 20% 30%, rgba(212, 175, 90, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 70%, rgba(117, 21, 37, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .hp-alumni-section .hp-section__badge {
            background: rgba(212, 175, 90, 0.15);
            color: #D4AF5A;
            border: 1px solid rgba(212, 175, 90, 0.3);
        }

        .hp-alumni-section .hp-section__title {
            color: #fff;
        }

        .hp-alumni-section .hp-section__desc {
            color: rgba(255, 255, 255, 0.7);
        }

        .hp-alumni-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.01) 100%);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-radius: 20px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
            border: 1px solid rgba(212, 175, 55, 0.2);
            position: relative;
        }

        /* Animated gradient border */
        .hp-alumni-card::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, #D4AF37, transparent, #8A1A33, transparent, #D4AF37);
            background-size: 300% 300%;
            border-radius: 22px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.5s ease;
            animation: borderGlow 4s ease infinite;
        }

        @keyframes borderGlow {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        /* Floating particles effect */
        .hp-alumni-card::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 150%;
            height: 150%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 60%);
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.6s ease;
            pointer-events: none;
        }

        .hp-alumni-card:hover {
            transform: translateY(-20px) scale(1.03);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6), 0 0 50px rgba(212, 175, 55, 0.2);
            border-color: rgba(212, 175, 55, 0.5);
            z-index: 10;
        }

        .hp-alumni-card:hover::before {
            opacity: 1;
        }

        .hp-alumni-card:hover::after {
            transform: translate(-50%, -50%) scale(1.2);
        }

        .hp-alumni-card__image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .hp-alumni-card__image::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: linear-gradient(to top, rgba(26, 15, 15, 0.9), transparent);
            z-index: 1;
        }

        .hp-alumni-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover !important;
            object-position: top !important;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1), filter 0.4s ease;
            filter: saturate(0.9);
        }

        .hp-alumni-card:hover .hp-alumni-card__image img {
            transform: scale(1.15);
            filter: saturate(1.1);
        }

        .hp-alumni-card__body {
            padding: 1.5rem 1.25rem 1.75rem;
            position: relative;
            z-index: 2;
        }

        .hp-alumni-card__name {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.3rem;
            transition: color 0.3s ease;
        }

        .hp-alumni-card:hover .hp-alumni-card__name {
            color: #D4AF5A;
        }

        .hp-alumni-card__dept {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 1rem;
            font-weight: 400;
        }

        .hp-alumni-card__badge {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            background: linear-gradient(135deg, var(--hp-gold) 0%, var(--hp-gold-dark) 100%);
            color: var(--hp-charcoal);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            border-radius: 4px;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.35);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .hp-alumni-card:hover .hp-alumni-card__badge {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(212, 175, 90, 0.5);
        }

        /* View Profile Link */
        .hp-alumni-card__link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(10px);
        }

        .hp-alumni-card:hover .hp-alumni-card__link {
            opacity: 1;
            transform: translateY(0);
            color: #D4AF5A;
        }

        .hp-alumni-card__link i {
            transition: transform 0.3s ease;
        }

        .hp-alumni-card__link:hover i {
            transform: translateX(4px);
        }


        /* ====================================================
                                                                                                                                                   GALLERY
                                                                                                                                                   ==================================================== */
        .hp-gallery-item {
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            height: 320px;
        }

        .hp-gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-slow);
        }

        .hp-gallery-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
            opacity: 0;
            transition: opacity var(--transition-normal);
            z-index: 1;
        }

        .hp-gallery-item:hover::before {
            opacity: 1;
        }

        .hp-gallery-item:hover img {
            transform: scale(1.1);
        }

        .hp-gallery-item__overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity var(--transition-normal);
            z-index: 2;
        }

        .hp-gallery-item:hover .hp-gallery-item__overlay {
            opacity: 1;
        }

        .hp-gallery-item__icon {
            width: 50px;
            height: 50px;
            background: var(--hp-gold);
            color: var(--hp-charcoal);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        /* ====================================================
                                                                                                                                                   NEWS CARDS - Editorial Style
                                                                                                                                                   ==================================================== */
        .hp-news-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .hp-news-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 5px 15px rgba(212, 175, 55, 0.15);
            border-color: rgba(212, 175, 55, 0.2);
        }

        .hp-news-card__image {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .hp-news-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-slow);
        }

        .hp-news-card:hover .hp-news-card__image img {
            transform: scale(1.08);
        }

        .hp-news-card__date-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #fff;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--hp-charcoal);
            box-shadow: var(--shadow-sm);
        }

        .hp-news-card__body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .hp-news-card__meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .hp-news-card__author-img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--hp-gold);
        }

        .hp-news-card__author-name {
            font-size: 0.9rem;
            color: var(--hp-charcoal);
            font-weight: 500;
        }

        .hp-news-card__category {
            margin-left: auto;
            padding: 0.25rem 0.75rem;
            background: rgba(117, 21, 37, 0.1);
            color: var(--hp-maroon);
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 50px;
        }

        .hp-news-card__title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--hp-charcoal);
            line-height: 1.4;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .hp-news-card__title a {
            color: inherit;
            text-decoration: none;
            transition: color var(--transition-fast);
        }

        .hp-news-card__title a:hover {
            color: var(--hp-gold);
        }

        .hp-news-card__footer {
            border-top: 1px solid var(--hp-gray-200);
            padding-top: 1rem;
            margin-top: auto;
        }

        /* ====================================================
                                                                                                                                                   READ MORE LINK
                                                                                                                                                   ==================================================== */
        .hp-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--hp-maroon);
            font-weight: 600;
            text-decoration: none;
            transition: all var(--transition-fast);
        }

        .hp-link:hover {
            color: var(--hp-gold);
            gap: 0.75rem;
        }

        .hp-link i {
            transition: transform var(--transition-fast);
        }

        .hp-link:hover i {
            transform: translateX(4px);
        }

        /* ====================================================
                                                                                                                                                   SWIPER CUSTOMIZATION
                                                                                                                                                   ==================================================== */
        .hp-swiper-nav {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .hp-swiper-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid var(--hp-gray-200);
            background: #fff;
            color: var(--hp-charcoal);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .hp-swiper-btn:hover {
            background: var(--hp-gold);
            border-color: var(--hp-gold);
            color: var(--hp-charcoal);
        }

        .hp-section--dark .hp-swiper-btn {
            border-color: rgba(255, 255, 255, 0.3);
            background: transparent;
            color: #fff;
        }

        .hp-section--dark .hp-swiper-btn:hover {
            background: var(--hp-gold);
            border-color: var(--hp-gold);
            color: var(--hp-charcoal);
        }

        /* ====================================================
                                                                                                                                                   RESPONSIVE
                                                                                                                                                   ==================================================== */
        @media (max-width: 991px) {
            .hp-about__content {
                padding-left: 0;
                margin-top: 3rem;
                text-align: center;
            }
            
            .hp-about__content .hp-section__title,
            .hp-about__content .hp-section__desc {
                text-align: center !important;
            }

            .hp-about__stat-card {
                right: 50%;
                transform: translateX(50%);
                bottom: -2rem;
            }
        }

        @media (max-width: 767px) {
            .hp-section {
                padding: 5rem 0;
            }

            .hp-hero {
                padding-top: 80px;
                min-height: 90vh;
            }

            .hp-hero__title {
                font-size: 2.75rem;
                letter-spacing: -0.02em;
            }

            .hp-hero__subtitle {
                font-size: 1.1rem;
                line-height: 1.6;
                margin-bottom: 2.5rem !important;
            }

            .hp-hero__actions {
                flex-direction: column;
                padding: 0 1rem;
            }

            .hp-btn {
                width: 100%;
                justify-content: center;
            }

            .hp-stat-item__number {
                font-size: 3.5rem;
            }

            .hp-section__title {
                font-size: 2.25rem;
            }
            
            .hp-benefit-card__icon {
                width: 120px;
                height: 120px;
            }
            
            .hp-benefit-card__icon img {
                width: 70px;
                height: 70px;
            }
        }

        /* ====================================================
                                                                                                                                                   REUNION COUNTDOWN SECTION
                                                                                                                                                   ==================================================== */
        .hp-countdown-section {
            position: relative;
            padding: 5rem 0;
            background: linear-gradient(135deg, var(--hp-charcoal) 0%, #1A1A2E 50%, var(--hp-maroon-dark) 100%);
            overflow: hidden;
        }

        .hp-countdown-overlay {
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23D4AF5A' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }

        .hp-countdown-wrapper {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 3rem;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 90, 0.3);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 0 40px rgba(212, 175, 90, 0.15);
        }

        .hp-countdown-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: rgba(212, 175, 90, 0.2);
            color: var(--hp-gold);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-radius: 50px;
            margin-bottom: 1.5rem;
        }

        .hp-countdown-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 2.75rem);
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.75rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .hp-countdown-location {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .hp-countdown-location i {
            color: var(--hp-gold);
            margin-right: 0.5rem;
        }

        .hp-countdown-timer {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .hp-countdown-item {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(212, 175, 90, 0.3);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            min-width: 100px;
            transition: all 0.3s ease;
        }

        .hp-countdown-item:hover {
            transform: translateY(-5px);
            border-color: var(--hp-gold);
            box-shadow: 0 10px 30px rgba(212, 175, 90, 0.2);
        }

        .hp-countdown-number {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 700;
            color: var(--hp-gold);
            line-height: 1;
            text-shadow: 0 0 20px rgba(212, 175, 90, 0.3);
        }

        .hp-countdown-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 0.5rem;
        }

        .hp-countdown-separator {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: rgba(255, 255, 255, 0.3);
            font-weight: bold;
            padding: 0 0.25rem;
        }

        @media (max-width: 767px) {
            .hp-countdown-wrapper {
                padding: 2rem 1.5rem;
            }

            .hp-countdown-item {
                padding: 1rem 1.25rem;
                min-width: 70px;
            }

            .hp-countdown-separator {
                font-size: 1.5rem;
                padding: 0 0.1rem;
            }
        }
    </style>

    <!-- ======================== HERO SECTION ======================== -->
    <section class="hp-hero" id="home">
        <div class="hp-hero__bg" style="background-image: url('{{ getSettingImage('banner_background_breadcrumb') }}');">
        </div>
        <div class="hp-hero__aurora"></div>
        <div class="hp-hero__overlay"></div>

        <!-- Floating Particles -->
        <div class="hp-particles">
            <span class="hp-particle"></span>
            <span class="hp-particle"></span>
            <span class="hp-particle"></span>
            <span class="hp-particle"></span>
            <span class="hp-particle"></span>
            <span class="hp-particle"></span>
            <span class="hp-particle"></span>
            <span class="hp-particle"></span>
        </div>

        <!-- Massive Glowing Orb for undeniable visual impact -->
        <div style="position: absolute; top: 50%; left: 50%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%); transform: translate(-50%, -50%); border-radius: 50%; filter: blur(40px); pointer-events: none; z-index: 1;"></div>

        <div class="hp-hero__content" data-aos="fade-up" data-aos-duration="1000" style="position: relative; z-index: 10;">
            <span class="hp-hero__badge" style="background: rgba(0,0,0,0.6); border: 2px solid #D4AF37; box-shadow: 0 0 60px rgba(212, 175, 55, 0.8); font-size: 1rem; padding: 1rem 2.5rem; border-radius: 50px;">
                <i class="fa-solid fa-gem fa-bounce" style="color: #D4AF37; margin-right: 12px; font-size: 1.2rem;"></i>
                <span style="letter-spacing: 0.3em; color: #fff;">{{ __('ELITE ALUMNI NETWORK') }}</span>
            </span>

            <h1 class="hp-hero__title">
                {{ getOption('banner_title') }}
            </h1>

            <p class="hp-hero__subtitle">
                {{ getOption('banner_description') }}
            </p>

            <div class="hp-hero__actions">
                <a href="#about-us-section" class="hp-btn hp-btn--primary">
                    {{ __('Discover More') }}
                    <i class="fa-solid fa-arrow-down"></i>
                </a>
                <a href="{{ route('all.event') }}" class="hp-btn hp-btn--outline">
                    {{ __('Upcoming Events') }}
                    <i class="fa-regular fa-calendar"></i>
                </a>
            </div>
        </div>

        <a href="#why-join-us" class="hp-hero__scroll">
            <span class="hp-hero__scroll-text">{{ __('Scroll') }}</span>
            <div class="hp-hero__scroll-mouse"></div>
        </a>
    </section>

    <!-- ======================== REUNION COUNTDOWN ======================== -->
    @if(getOption('reunion_countdown_enabled') && getOption('reunion_date'))
        @php
            $reunionDate = getOption('reunion_date');
            $reunionTitle = getOption('reunion_title', 'Annual Alumni Reunion');
            $reunionLocation = getOption('reunion_location', '');
        @endphp
        <section class="hp-countdown-section">
            <div class="hp-countdown-overlay"></div>
            <div class="container position-relative" style="z-index: 10;">
                <div class="hp-countdown-wrapper" data-aos="fade-up">
                    <span class="hp-countdown-badge">
                        <i class="bi bi-calendar-event"></i> {{ __('Upcoming Event') }}
                    </span>
                    <h2 class="hp-countdown-title">{{ $reunionTitle }}</h2>
                    @if($reunionLocation)
                        <p class="hp-countdown-location">
                            <i class="bi bi-geo-alt"></i> {{ $reunionLocation }}
                        </p>
                    @endif
                    <div class="hp-countdown-timer" id="reunionCountdown" data-target="{{ $reunionDate }}">
                        <div class="hp-countdown-item">
                            <div class="hp-countdown-number" id="countdown-days">00</div>
                            <div class="hp-countdown-label">{{ __('Days') }}</div>
                        </div>
                        <div class="hp-countdown-separator">:</div>
                        <div class="hp-countdown-item">
                            <div class="hp-countdown-number" id="countdown-hours">00</div>
                            <div class="hp-countdown-label">{{ __('Hours') }}</div>
                        </div>
                        <div class="hp-countdown-separator">:</div>
                        <div class="hp-countdown-item">
                            <div class="hp-countdown-number" id="countdown-minutes">00</div>
                            <div class="hp-countdown-label">{{ __('Minutes') }}</div>
                        </div>
                        <div class="hp-countdown-separator">:</div>
                        <div class="hp-countdown-item">
                            <div class="hp-countdown-number" id="countdown-seconds">00</div>
                            <div class="hp-countdown-label">{{ __('Seconds') }}</div>
                        </div>
                    </div>
                    <a href="{{ route('all.event') }}" class="hp-btn hp-btn--primary mt-4">
                        {{ __('View All Events') }}
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- ======================== WHY JOIN US ======================== -->
    <section class="hp-section hp-section--cream" id="why-join-us">
        <div class="container">
            <div class="hp-section__header" data-aos="fade-up">
                <span class="hp-section__badge">{{ __('Community Benefits') }}</span>
                <h2 class="hp-section__title">{{ __('Why You Should Join Us') }}</h2>
                <p class="hp-section__desc">
                    {{ __('Discover the advantages of being part of our extensive alumni network. Connect, grow, and give back.') }}
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="hp-benefit-card">
                        <div class="hp-benefit-card__icon">
                            <img src="{{ getSettingImage('join_us_left_icon') }}" alt=""
                                onerror="this.src='{{ asset('assets/images/icon/network.svg') }}'">
                        </div>
                        <h4 class="hp-benefit-card__title">{{ getOption('join_us_left_title') ?: __('Connect & Network') }}
                        </h4>
                        <div class="hp-benefit-card__text">
                            {!! getOption('join_us_left_description') ?: __('Build meaningful connections with fellow alumni across the globe.') !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="hp-benefit-card">
                        <div class="hp-benefit-card__icon">
                            <img src="{{ getSettingImage('join_us_middle_icon') }}" alt=""
                                onerror="this.src='{{ asset('assets/images/icon/growth.svg') }}'">
                        </div>
                        <h4 class="hp-benefit-card__title">{{ getOption('join_us_middle_title') ?: __('Grow Together') }}
                        </h4>
                        <div class="hp-benefit-card__text">
                            {!! getOption('join_us_middle_description') ?: __('Access exclusive resources, mentorship, and career opportunities.') !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="hp-benefit-card">
                        <div class="hp-benefit-card__icon">
                            <img src="{{ getSettingImage('join_us_right_icon') }}" alt=""
                                onerror="this.src='{{ asset('assets/images/icon/give-back.svg') }}'">
                        </div>
                        <h4 class="hp-benefit-card__title">{{ getOption('join_us_right_title') ?: __('Give Back') }}</h4>
                        <div class="hp-benefit-card__text">
                            {!! getOption('join_us_right_description') ?: __('Support current students and contribute to the future of education.') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================== ABOUT US ======================== -->
    <section class="hp-section" id="about-us-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="hp-about__image-wrap">
                        <div class="hp-about__image">
                            <img src="{{ getSettingImage('about_us_background_breadcrumb') }}" alt="{{ __('About Us') }}"
                                onerror="this.src='{{ asset('assets/images/about-placeholder.jpg') }}'">
                        </div>
                        <div class="hp-about__stat-card">
                            <div class="hp-about__stat-number counter">{{ $totalAlumni }}</div>
                            <div class="hp-about__stat-label">{{ __('Active Members') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="hp-about__content">
                        <span class="hp-section__badge">{{ __('About Us') }}</span>
                        <h2 class="hp-section__title text-start">{{ getOption('about_us_title') ?: __('Our Story') }}</h2>
                        <div class="hp-section__desc text-start mx-0 mb-4">
                            {!! getOption('about_us_description') ?: __('We are a community of proud graduates committed to supporting each other and giving back to our alma mater.') !!}
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="{{ route('register') }}" class="hp-btn hp-btn--maroon">
                                {{ __('Join Our Community') }}
                                <i class="fa-solid fa-user-plus"></i>
                            </a>
                            <a href="{{ route('our.history') }}" class="hp-btn hp-btn--outline">
                                {{ __('Read Our Full History') }}
                                <i class="fa-solid fa-book-open"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ======================== EXECUTIVES ======================== -->
    @if(isset($excos) && count($excos) > 0)
        <section class="hp-section hp-alumni-section" id="executives">
            <div class="container position-relative" style="z-index: 10;">
                <div class="hp-section__header" data-aos="fade-up">
                    <span class="hp-section__badge">{{ __('Leadership') }}</span>
                    <h2 class="hp-section__title">{{ __('Our Executives') }}</h2>
                    <p class="hp-section__desc">
                        {{ __('Meet the dedicated individuals currently leading our alumni association.') }}
                        @if(!empty($currentTenorName))
                            <br><span style="color: var(--hp-gold); font-weight: 600;" class="mt-2 d-inline-block">{{ $currentTenorName }}</span>
                        @endif
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach($excos->take(8) as $exco)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="hp-alumni-card">
                                <div class="hp-alumni-card__image">
                                    @if($exco->photo)
                                        <img src="{{ asset($exco->photo) }}" alt="{{ $exco->name }}">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.2);">
                                            <i class="fa-solid fa-user text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="hp-alumni-card__body">
                                    <h4 class="hp-alumni-card__name">{{ $exco->name }}</h4>
                                    <div class="hp-alumni-card__dept" style="color: var(--hp-gold);">{{ $exco->position }}</div>
                                    <span class="hp-alumni-card__badge">{{ __('Exco') }}</span>
                                    
                                    @if($exco->bio)
                                        <div class="d-block w-100"></div>
                                        <a href="{{ route('excos') }}" class="hp-alumni-card__link">
                                            {{ __('View Profile') }} <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-5" data-aos="fade-up">
                    <a href="{{ route('excos') }}" class="hp-btn hp-btn--outline">
                        {{ __('Meet the Full Team') }}
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- ======================== UPCOMING EVENTS ======================== -->
    @if (count($upcomingEvents ?? []))
        <section class="hp-section hp-section--cream">
            <div class="container">
                <div class="hp-section__header" data-aos="fade-up">
                    <span class="hp-section__badge">{{ __('Save the Date') }}</span>
                    <h2 class="hp-section__title">{{ __('Upcoming Events') }}</h2>
                    <p class="hp-section__desc">
                        {{ __('Connect with fellow graduates, attend reunions, and stay updated with our community activities.') }}
                    </p>
                </div>

                <div class="swiper upcomingEvent" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper-wrapper">
                        @foreach ($upcomingEvents as $event)
                            <div class="swiper-slide">
                                <div class="hp-event-card">
                                    <div class="hp-event-card__image">
                                        <img src="{{ getFileUrl($event->thumbnail) }}" alt="{{ $event->title }}">
                                        <div class="hp-event-card__date">
                                            <div class="hp-event-card__date-day">
                                                {{ \Carbon\Carbon::parse($event->date)->format('d') }}
                                            </div>
                                            <div class="hp-event-card__date-month">
                                                {{ \Carbon\Carbon::parse($event->date)->format('M') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hp-event-card__body">
                                        <div class="hp-event-card__meta">
                                            <span><i
                                                    class="fa-regular fa-clock me-1"></i>{{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</span>
                                            <span><i class="fa-solid fa-location-dot me-1"></i>{{ $event->location }}</span>
                                        </div>
                                        <h4 class="hp-event-card__title">
                                            <a href="{{ route('event.view.details', $event->slug) }}">{{ $event->title }}</a>
                                        </h4>
                                        <a href="{{ route('event.view.details', $event->slug) }}" class="hp-link">
                                            {{ __('View Details') }} <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="hp-swiper-nav">
                        <button class="hp-swiper-btn swiper-button-prev"><i class="fa-solid fa-arrow-left"></i></button>
                        <button class="hp-swiper-btn swiper-button-next"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ======================== SUCCESS STORIES ======================== -->
    @if (count($stories ?? []))
        <section class="hp-section">
            <div class="container">
                <div class="hp-section__header" data-aos="fade-up">
                    <span class="hp-section__badge">{{ __('Inspiring Journeys') }}</span>
                    <h2 class="hp-section__title">{{ __('Success Stories') }}</h2>
                    <p class="hp-section__desc">
                        {{ __('Discover the remarkable achievements of our alumni community members.') }}
                    </p>
                </div>

                <div class="row g-4">
                    @foreach ($stories as $index => $story)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                            <div class="hp-story-card">
                                <div class="hp-story-card__image">
                                    <img src="{{ getFileUrl($story->thumbnail) }}" alt="{{ $story->title }}">
                                </div>
                                <div class="hp-story-card__body">
                                    <div class="hp-story-card__date">
                                        {{ \Carbon\Carbon::parse($story->created_at)->format('M d, Y') }}
                                    </div>
                                    <h4 class="hp-story-card__title">
                                        <a href="{{ route('story.view', $story->slug) }}">{{ $story->title }}</a>
                                    </h4>
                                    <a href="{{ route('story.view', $story->slug) }}" class="hp-link">
                                        {{ __('Read Story') }} <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ======================== RECENTLY JOINED ALUMNI ======================== -->
    @if (count($alumnus ?? []))
        <section class="hp-section hp-alumni-section">
            <div class="container position-relative" style="z-index: 1;">
                <div class="hp-section__header" data-aos="fade-up">
                    <span class="hp-section__badge">{{ __('Fresh Faces') }}</span>
                    <h2 class="hp-section__title">{{ __('Recently Joined Alumni') }}</h2>
                    <p class="hp-section__desc">
                        {{ __('Welcoming our newest members to the ever-growing family.') }}
                    </p>
                </div>

                <div class="row g-4">
                    @foreach ($alumnus as $index => $alumni)
                        <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ 100 * (($index % 4) + 1) }}">
                            <div class="hp-alumni-card">
                                <div class="hp-alumni-card__image">
                                    <img src="{{ getFileUrl($alumni->image) }}" alt="{{ $alumni->name }}">
                                </div>
                                <div class="hp-alumni-card__body">
                                    <h4 class="hp-alumni-card__name">{{ $alumni->name }}</h4>
                                    <p class="hp-alumni-card__dept">{{ $alumni->final_class_name ?? 'N/A' }}</p>
                                    <span class="hp-alumni-card__badge">{{ $alumni->final_house_name ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ======================== IMAGE GALLERY ======================== -->
    @if (count($photoGalleries ?? []))
        <section class="hp-section">
            <div class="container">
                <div class="hp-section__header" data-aos="fade-up">
                    <span class="hp-section__badge">{{ __('Memories') }}</span>
                    <h2 class="hp-section__title">{{ __('Photo Gallery') }}</h2>
                </div>

                <div class="swiper imageGallery" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper-wrapper">
                        @foreach ($photoGalleries as $photo)
                            <div class="swiper-slide">
                                <div class="hp-gallery-item">
                                    <a href="{{ getFileUrl($photo->photo) }}" class="glightbox" data-gallery="gallery1">
                                        <img src="{{ getFileUrl($photo->photo) }}" alt="{{ $photo->caption }}">
                                        <div class="hp-gallery-item__overlay">
                                            <div class="hp-gallery-item__icon"><i class="fa-solid fa-expand"></i></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="hp-swiper-nav">
                        <button class="hp-swiper-btn swiper-button-prev"><i class="fa-solid fa-arrow-left"></i></button>
                        <button class="hp-swiper-btn swiper-button-next"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ======================== LATEST NEWS ======================== -->
    @if (count($news ?? []))
        <section class="hp-section hp-section--cream">
            <div class="container">
                <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3" data-aos="fade-up">
                    <div>
                        <span class="hp-section__badge">{{ __('News & Updates') }}</span>
                        <h2 class="hp-section__title mb-0 text-start">{{ __('Latest News') }}</h2>
                    </div>
                    <a href="{{ route('our.news') }}" class="hp-link fs-5">
                        {{ __('View All News') }} <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach ($news as $index => $article)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                            <div class="hp-news-card">
                                <div class="hp-news-card__image">
                                    <img src="{{ getFileUrl($article->image) }}" alt="{{ $article->title }}">
                                    <span
                                        class="hp-news-card__date-badge">{{ \Carbon\Carbon::parse($article->created_at)->format('M d') }}</span>
                                </div>
                                <div class="hp-news-card__body">
                                    <div class="hp-news-card__meta">
                                        <img src="{{ getFileUrl($article->author->image) }}" alt=""
                                            class="hp-news-card__author-img">
                                        <span class="hp-news-card__author-name">{{ $article->author->name }}</span>
                                        <span class="hp-news-card__category">{{ $article->category->name }}</span>
                                    </div>
                                    <h4 class="hp-news-card__title">
                                        <a href="{{ route('news.view.details', $article->slug) }}">{{ $article->title }}</a>
                                    </h4>
                                    <div class="hp-news-card__footer">
                                        <a href="{{ route('news.view.details', $article->slug) }}" class="hp-link">
                                            {{ __('Read Article') }} <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ======================== DID YOU KNOW? ======================== -->
    @php
        $showFunFacts = getOption('fun_facts_status') && getOption('fun_facts_list');
        $showPoll = isset($activePoll) && $activePoll;
    @endphp

    @if($showFunFacts || $showPoll)
        <section class="hp-section hp-section--dark">
            <div class="container">
                <div class="row {{ ($showFunFacts && $showPoll) ? '' : 'justify-content-center' }} g-5">
                    
                    {{-- FUN FACTS --}}
                    @if($showFunFacts)
                        <div class="{{ $showPoll ? 'col-lg-6' : 'col-lg-10' }}">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4">
                                    <span class="hp-section__badge">{{ __('School Trivia') }}</span>
                                    <h2 class="hp-section__title text-start text-white mb-2">{{ __('Did You Know?') }}</h2>
                                    <p class="hp-section__desc text-start mx-0">
                                        {{ __('Interesting facts and historical tidbits about our beloved alma mater.') }}
                                    </p>
                                </div>
                                
                                <div class="hp-fact-card flex-grow-1 d-flex flex-column justify-content-center" 
                                    style="background: rgba(255,255,255,0.05); border: 1px solid rgba(212, 175, 90, 0.2); border-radius: 20px; padding: 3rem; position: relative;">
                                    <i class="fa-solid fa-lightbulb" style="position: absolute; top: 2rem; right: 2rem; font-size: 3rem; color: var(--hp-gold); opacity: 0.1;"></i>
                                    <div id="fun-fact-display" style="font-family: 'Playfair Display', serif; font-size: 1.5rem; color: #fff; line-height: 1.6; min-height: 100px; display: flex; align-items: center;">
                                        <!-- Fact will load here -->
                                    </div>
                                    <div class="mt-4">
                                        <button id="next-fact-btn" class="btn btn-outline-light btn-sm rounded-pill px-4">
                                            <i class="fa-solid fa-sync-alt me-2"></i> {{ __('Next Fact') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- MINI POLL --}}
                    @if($showPoll)
                        <div class="{{ $showFunFacts ? 'col-lg-6' : 'col-lg-8' }}">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4">
                                    <span class="hp-section__badge">{{ __('Your Voice') }}</span>
                                    <h2 class="hp-section__title text-start text-white mb-2">{{ __('Community Poll') }}</h2>
                                    <p class="hp-section__desc text-start mx-0">
                                        {{ __('Participate in our latest community poll.') }}
                                    </p>
                                </div>

                                <div class="hp-poll-card" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(212, 175, 90, 0.2); border-radius: 20px; padding: 3rem;">
                                    <h4 class="text-white mb-4" style="font-family: 'Playfair Display', serif;">{{ $activePoll->question }}</h4>
                                    
                                    <div id="poll-area">
                                        @if(isset($hasVoted) && $hasVoted)
                                            <!-- Results View -->
                                            <div class="poll-results">
                                                @php 
                                                    $totalVotes = $activePoll->votes()->count(); 
                                                @endphp
                                                @foreach($activePoll->options as $option)
                                                    @php 
                                                        $percent = $totalVotes > 0 ? round(($option->vote_count / $totalVotes) * 100) : 0; 
                                                    @endphp
                                                    <div class="mb-3">
                                                        <div class="d-flex justify-content-between text-white-50 mb-1">
                                                            <span>{{ $option->option_text }}</span>
                                                            <span>{{ $percent }}%</span>
                                                        </div>
                                                        <div class="progress" style="height: 6px; background: rgba(255,255,255,0.1);">
                                                            <div class="progress-bar bg-gold" role="progressbar" style="width: {{ $percent }}%; background-color: var(--hp-gold);"></div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <p class="text-white-50 mt-3 small"><i class="fa-solid fa-check-circle text-success me-1"></i> {{ __('You have voted in this poll.') }}</p>
                                            </div>
                                        @else
                                            <!-- Voting Form -->
                                            <form id="mini-poll-form">
                                                <input type="hidden" name="poll_id" value="{{ $activePoll->id }}">
                                                @foreach($activePoll->options as $option)
                                                    <div class="form-check mb-3 custom-radio">
                                                        <input class="form-check-input" type="radio" name="option_id" id="opt-{{ $option->id }}" value="{{ $option->id }}">
                                                        <label class="form-check-label text-white" for="opt-{{ $option->id }}" style="cursor: pointer;">
                                                            {{ $option->option_text }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                <button type="submit" class="btn btn-primary mt-2">{{ __('Submit Vote') }}</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @push('script')
            @if($showFunFacts)
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const factsRaw = `{!! addslashes(getOption('fun_facts_list')) !!}`;
                    const facts = factsRaw.split('\n').filter(line => line.trim() !== '');
                    const display = document.getElementById('fun-fact-display');
                    const btn = document.getElementById('next-fact-btn');

                    if (facts.length > 0 && display) {
                        function showRandomFact() {
                            const random = facts[Math.floor(Math.random() * facts.length)];
                            display.style.opacity = 0;
                            setTimeout(() => {
                                display.innerText = random;
                                display.style.opacity = 1;
                            }, 300);
                        }
                        showRandomFact();
                        btn.addEventListener('click', function () {
                            const icon = this.querySelector('i');
                            icon.classList.add('fa-spin');
                            showRandomFact();
                            setTimeout(() => icon.classList.remove('fa-spin'), 500);
                        });
                        display.style.transition = 'opacity 0.3s ease';
                    } else if(display) {
                        display.innerText = "No facts available.";
                    }
                });
            </script>
            @endif

            @if($showPoll)
            <script>
                $(document).ready(function() {
                    $('#mini-poll-form').on('submit', function(e) {
                        e.preventDefault();
                        const form = $(this);
                        const btn = form.find('button[type="submit"]');
                        const data = form.serialize();

                        if(!form.find('input[name="option_id"]:checked').length) {
                            toastr.error("{{ __('Please select an option') }}");
                            return;
                        }

                        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

                        $.ajax({
                            url: "{{ route('mini-poll.vote') }}",
                            type: "POST",
                            data: data + "&_token={{ csrf_token() }}",
                            success: function(res) {
                                toastr.success(res.message);
                                renderResults(res.data.results);
                            },
                            error: function(err) {
                                btn.prop('disabled', false).text("{{ __('Submit Vote') }}");
                                if(err.responseJSON && err.responseJSON.message) {
                                    toastr.error(err.responseJSON.message);
                                } else {
                                    toastr.error("{{ __('Something went wrong') }}");
                                }
                            }
                        });
                    });

                    function renderResults(data) {
                        let html = '<div class="poll-results">';
                        data.options.forEach(opt => {
                            html += `
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between text-white-50 mb-1">
                                        <span>${opt.text}</span>
                                        <span>${opt.percent}%</span>
                                    </div>
                                    <div class="progress" style="height: 6px; background: rgba(255,255,255,0.1);">
                                        <div class="progress-bar bg-gold" role="progressbar" style="width: ${opt.percent}%; background-color: var(--hp-gold);"></div>
                                    </div>
                                </div>
                            `;
                        });
                        html += '<p class="text-white-50 mt-3 small"><i class="fa-solid fa-check-circle text-success me-1"></i> {{ __("Thank you for voting!") }}</p></div>';
                        $('#poll-area').html(html);
                    }
                });
            </script>
            @endif
        @endpush
    @endif

    @push('style')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @endpush

    @push('script')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            $(document).ready(function () {
                AOS.init({
                    duration: 800,
                    once: true,
                    offset: 50,
                    easing: 'ease-out-cubic'
                });

                $(window).scroll(function () {
                    var scrolled = $(window).scrollTop();
                    if (scrolled < window.innerHeight) {
                        $('.hp-hero__bg').css('transform', 'scale(1.1) translateY(' + (scrolled * 0.3) + 'px)');
                    }
                });

                const counters = document.querySelectorAll('.counter');

                const animateCounter = (counter) => {
                    const target = parseInt(counter.innerText) || 0;
                    const duration = 2000;
                    const startTime = performance.now();

                    const updateCounter = (currentTime) => {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const easeOut = 1 - Math.pow(1 - progress, 3);
                        const current = Math.floor(target * easeOut);

                        counter.innerText = current;

                        if (progress < 1) {
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.innerText = target;
                        }
                    };

                    counter.innerText = '0';
                    requestAnimationFrame(updateCounter);
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounter(entry.target);
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });

                counters.forEach(counter => {
                    counter.dataset.target = counter.innerText;
                    observer.observe(counter);
                });
            });
        </script>

        <!-- Reunion Countdown Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const countdown = document.getElementById('reunionCountdown');
                if (!countdown) return;

                const targetDate = countdown.dataset.target;
                if (!targetDate) return;

                const target = new Date(targetDate).getTime();

                function updateCountdown() {
                    const now = new Date().getTime();
                    const diff = target - now;

                    if (diff <= 0) {
                        document.getElementById('countdown-days').textContent = '00';
                        document.getElementById('countdown-hours').textContent = '00';
                        document.getElementById('countdown-minutes').textContent = '00';
                        document.getElementById('countdown-seconds').textContent = '00';
                        return;
                    }

                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    document.getElementById('countdown-days').textContent = days.toString().padStart(2, '0');
                    document.getElementById('countdown-hours').textContent = hours.toString().padStart(2, '0');
                    document.getElementById('countdown-minutes').textContent = minutes.toString().padStart(2, '0');
                    document.getElementById('countdown-seconds').textContent = seconds.toString().padStart(2, '0');
                }

                updateCountdown();
                setInterval(updateCountdown, 1000);
            });
        </script>
    @endpush
@endsection