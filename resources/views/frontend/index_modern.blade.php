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

        /* -- Revolutionary Design Tokens -- */
        :root {
            /* Primary Palette - Enhanced */
            --hp-maroon: #751525;
            --hp-maroon-dark: #5a1020;
            --hp-maroon-glow: rgba(117, 21, 37, 0.6);
            --hp-gold: #D4AF5A;
            --hp-gold-light: #E8D4A8;
            --hp-gold-dark: #B8934A;
            --hp-gold-glow: rgba(212, 175, 90, 0.5);

            /* Obsidian Dark Mode */
            --hp-obsidian: #0D0D0D;
            --hp-charcoal: #1A1A2E;
            --hp-slate: #2D2D44;
            --hp-smoke: rgba(255, 255, 255, 0.08);

            /* Neutrals */
            --hp-ivory: #FEFDFB;
            --hp-cream: #FAF8F5;
            --hp-gray-100: #F8F9FA;
            --hp-gray-200: #E9ECEF;
            --hp-gray-500: #6C757D;
            --hp-gray-800: #343A40;

            /* Revolutionary Shadows */
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.12);
            --shadow-gold: 0 8px 32px rgba(212, 175, 90, 0.25);
            --shadow-gold-intense: 0 0 60px rgba(212, 175, 90, 0.4);
            --shadow-maroon: 0 8px 32px rgba(117, 21, 37, 0.3);
            --shadow-3d: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            --shadow-glass: 0 8px 32px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.1);

            /* Glassmorphism */
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-bg-light: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(212, 175, 90, 0.2);
            --glass-blur: blur(20px);

            /* Transitions */
            --transition-fast: 0.2s ease;
            --transition-normal: 0.3s ease;
            --transition-slow: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            --transition-magnetic: 0.3s cubic-bezier(0.4, 0, 0.2, 1);

            /* Aurora Effect Colors */
            --aurora-1: rgba(117, 21, 37, 0.4);
            --aurora-2: rgba(212, 175, 90, 0.3);
            --aurora-3: rgba(26, 26, 46, 0.9);
        }

        /* -- Typography -- */
        .hp-font-display {
            font-family: 'Playfair Display', Georgia, serif;
        }

        .hp-font-body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
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
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            margin-bottom: 2.5rem;
            box-shadow: 0 0 30px rgba(212, 175, 90, 0.2);
            animation: pulseGlow 4s ease-in-out infinite;
        }

        /* 3D Floating Title */
        .hp-hero__title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 7vw, 5rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            text-shadow:
                0 1px 0 rgba(0, 0, 0, 0.3),
                0 2px 0 rgba(0, 0, 0, 0.25),
                0 4px 0 rgba(0, 0, 0, 0.2),
                0 8px 16px rgba(0, 0, 0, 0.4),
                0 16px 32px rgba(0, 0, 0, 0.3);
            transform-style: preserve-3d;
        }

        .hp-hero__title em {
            font-style: normal;
            color: var(--hp-gold);
            text-shadow:
                0 0 20px var(--hp-gold-glow),
                0 0 40px rgba(212, 175, 90, 0.3);
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
                opacity: 0;
                transform: translateX(-50%) translateY(10px);
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
            background: linear-gradient(135deg, var(--hp-gold) 0%, var(--hp-gold-dark) 100%);
            color: var(--hp-charcoal);
            border-color: var(--hp-gold);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }

        .hp-btn--primary:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: var(--shadow-gold-intense);
            color: var(--hp-charcoal);
        }

        .hp-btn--outline {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.3);
        }

        .hp-btn--outline:hover {
            background: rgba(212, 175, 90, 0.15);
            border-color: var(--hp-gold);
            color: var(--hp-gold);
            transform: translateY(-4px);
            box-shadow: 0 0 30px rgba(212, 175, 90, 0.2);
        }

        .hp-btn--maroon {
            background: linear-gradient(135deg, var(--hp-maroon) 0%, var(--hp-maroon-dark) 100%);
            color: #fff;
            border-color: var(--hp-maroon);
            box-shadow: 0 4px 15px rgba(117, 21, 37, 0.3);
        }

        .hp-btn--maroon:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 8px 32px rgba(117, 21, 37, 0.4);
            color: #fff;
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
            background: var(--glass-bg-light);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 2.5rem 2rem;
            border-radius: 8px;
            /* Sharp corners */
            text-align: center;
            height: 100%;
            border: 1px solid rgba(212, 175, 90, 0.15);
            transition: all var(--transition-slow);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        /* Gradient border glow effect */
        .hp-benefit-card::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, var(--hp-maroon), var(--hp-gold), var(--hp-maroon));
            border-radius: 10px;
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
            transform: translateY(-12px) perspective(1000px) rotateX(2deg);
            box-shadow: var(--shadow-3d), 0 0 40px rgba(212, 175, 90, 0.15);
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
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.02) 100%);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 16px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            border: 1px solid rgba(212, 175, 90, 0.15);
            position: relative;
        }

        /* Animated gradient border */
        .hp-alumni-card::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, #D4AF5A, transparent, #751525, transparent, #D4AF5A);
            background-size: 300% 300%;
            border-radius: 18px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.4s ease;
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
            background: radial-gradient(circle, rgba(212, 175, 90, 0.1) 0%, transparent 60%);
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.6s ease;
            pointer-events: none;
        }

        .hp-alumni-card:hover {
            transform: translateY(-16px) scale(1.02);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.4), 0 0 40px rgba(212, 175, 90, 0.15);
            border-color: rgba(212, 175, 90, 0.4);
        }

        .hp-alumni-card:hover::before {
            opacity: 1;
        }

        .hp-alumni-card:hover::after {
            transform: translate(-50%, -50%) scale(1);
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
            object-fit: cover;
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
            background: linear-gradient(135deg, #D4AF5A 0%, #B8934A 100%);
            color: #1A0F0F;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(212, 175, 90, 0.35);
            transition: all 0.3s ease;
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
            transition: all var(--transition-normal);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .hp-news-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
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
                margin-top: 4rem;
            }

            .hp-about__stat-card {
                right: 1rem;
                bottom: -1.5rem;
            }
        }

        @media (max-width: 767px) {
            .hp-section {
                padding: 4rem 0;
            }

            .hp-hero__title {
                font-size: 2.25rem;
            }

            .hp-stat-item__number {
                font-size: 3rem;
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

        <div class="hp-hero__content" data-aos="fade-up" data-aos-duration="1000">
            <span class="hp-hero__badge">
                <i class="fa-solid fa-sparkles"></i>
                {{ __('Welcome to the Community') }}
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
                        <a href="{{ route('register') }}" class="hp-btn hp-btn--maroon">
                            {{ __('Join Our Community') }}
                            <i class="fa-solid fa-user-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
    @endpush
@endsection