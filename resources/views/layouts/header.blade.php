<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ getOption('app_name') }} - @stack('title' ?? '')</title>

    @hasSection('meta')
        @stack('meta')
    @else
        @php
            $metaData = getMeta('home');
        @endphp

        <meta name="description" content="{{ __($metaData['meta_description']) ?? getOption('app_name') }}">
        <meta name="keywords" content="{{ __($metaData['meta_keyword']) }}">

        <!-- Open Graph meta tags for social sharing -->
        <meta property="og:type" content="{{ __('Alumni') }}">
        <meta property="og:title" content="{{ __($metaData['meta_title']) ?? getOption('app_name') }}">
        <meta property="og:description" content="{{ __($metaData['meta_description']) ?? getOption('app_name') }}">
        @if(centralDomain() && isAddonInstalled('ALUSAAS'))
            <meta property="og:image" content="{{ __($metaData['og_image']) ?? getSettingImage('app_logo') }}">
        @else
            <meta property="og:image" content="{{ __($metaData['og_image']) ?? getSettingImageCentral('app_logo') }}">
        @endif
        <meta property="og:url" content="{{ url()->current() }}">

        <meta property="og:site_name" content="{{ __(getOption('app_name')) }}">

        <!-- Twitter Card meta tags for Twitter sharing -->
        <meta name="twitter:card" content="{{ __('Alumni') }}">
        <meta name="twitter:title" content="{{ __($metaData['meta_title']) ?? getOption('app_name') }}">
        <meta name="twitter:description" content="{{ __($metaData['meta_description']) ?? getOption('app_name') }}">
        @if(centralDomain() && isAddonInstalled('ALUSAAS'))
            <meta name="twitter:image" content="{{ __($metaData['og_image']) ?? getSettingImageCentral('app_logo') }}">
        @else
            <meta name="twitter:image" content="{{ __($metaData['og_image']) ?? getSettingImage('app_logo') }}">
        @endif

        <meta name="csrf-token" content="{{ csrf_token() }}" />
    @endif

    <!-- Place favicon.ico in the root directory -->
    @if(centralDomain() && isAddonInstalled('ALUSAAS'))
        <link rel="icon" href="{{ getSettingImageCentral('app_fav_icon') }}" type="image/png" sizes="16x16">
        <link rel="shortcut icon" href="{{ getSettingImageCentral('app_fav_icon') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ getSettingImageCentral('app_fav_icon') }}">
    @else
        <link rel="icon" href="{{ getSettingImage('app_fav_icon') }}" type="image/png" sizes="16x16">
        <link rel="shortcut icon" href="{{ getSettingImage('app_fav_icon') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ getSettingImage('app_fav_icon') }}">
    @endif

    <!-- PWA Meta Tags -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#6366f1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="{{ getOption('app_name') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/pwa/icon-192x192.png') }}">

    <!-- fonts file -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@100;200;300;400;500;600;700;800;900&family=Nunito:wght@200;300;400;500;600;700;800;900;1000&display=swap"
        rel="stylesheet" />
    <!-- css file  -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.responsive.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/scss/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/summernote/summernote-lite.min.css') }}" />
    <script src="{{ asset('assets/js/modernizr-3.11.2.min.js') }}"></script>
    @stack('style')

    <!-- Alumni Dashboard UI Kit - True Dark Theme -->
    <style>
        /* ============================================
           ALUMNI DASHBOARD UI KIT - TRUE DARK THEME
           No Gray State - Deep Blacks & Rich Surfaces
           ============================================ */

        /* CSS Variables - Dark Theme Palette */
        :root {
            /* Core Dark Palette */
            --bg-primary: #0B0E11;
            --bg-surface: #12161C;
            --bg-elevated: #171C23;
            --border-dark: #1F2630;

            /* Brand Colors (Dark-Optimized) */
            --maroon: #8B2635;
            --maroon-dark: #6a1d28;
            --gold: #D4AF5A;
            --gold-light: rgba(212, 175, 90, 0.15);

            /* Typography Colors */
            --text-primary: #E6EAF0;
            --text-secondary: #B4BCC8;
            --text-muted: #8C96A6;
            --text-disabled: #5E6675;

            /* Status Colors (Dark Optimized) */
            --success: #3FA36C;
            --warning: #F1B94E;
            --error: #E55353;
            --info: #4C8EDA;

            /* Spacing */
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        /* ============================================
           GLOBAL LAYOUT & BACKGROUND
           ============================================ */
        body,
        body.bg-secondary {
            background-color: var(--bg-primary) !important;
            color: var(--text-primary) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
        }

        .p-30 {
            padding: 24px !important;
        }

        .zMainContent {
            background-color: var(--bg-primary) !important;
        }

        /* ============================================
           PAGE TITLES & HEADINGS
           ============================================ */
        .fs-24.fw-500.text-black,
        .fs-24.fw-500,
        h4.fs-24,
        .text-black.fs-24 {
            font-family: 'Playfair Display', serif !important;
            color: var(--text-primary) !important;
            font-size: 24px !important;
            font-weight: 600 !important;
        }

        h4.fs-20,
        h4.fs-18,
        .fs-20.fw-600,
        .fs-18.fw-600,
        .fs-18.fw-500 {
            color: var(--text-primary) !important;
            font-family: 'Playfair Display', serif !important;
        }

        /* Text Color Overrides */
        .text-1b1c17,
        .text-black {
            color: var(--text-primary) !important;
        }

        .text-707070 {
            color: var(--text-secondary) !important;
        }

        p.fs-14,
        p.fs-12,
        .fs-14.fw-400 {
            color: var(--text-secondary) !important;
        }

        /* ============================================
           SECTION HEADERS WITH GOLD ICONS
           ============================================ */
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .section-header .icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.15) 0%, rgba(212, 175, 90, 0.08) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 18px;
        }

        .section-header h4 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary) !important;
            margin: 0;
        }

        .section-header p {
            font-size: 13px;
            color: var(--text-secondary) !important;
            margin: 0;
        }

        /* Generic gold icon styling */
        .gold-icon {
            color: var(--gold) !important;
        }

        .icon-box-gold {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.15) 0%, rgba(212, 175, 90, 0.08) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
        }

        /* ============================================
           CARDS & SURFACES
           ============================================ */
        .bg-white,
        .bg-white.bd-half,
        .bg-white.bd-one,
        .bg-white.bd-ra-25,
        .p-25.bg-white,
        .p-30.bg-white,
        .zPost-item,
        .bd-one.bd-c-ebedf0,
        .bd-half.bd-c-ebedf0,
        .bg-f9f9f9,
        .bg-fafafa {
            background-color: var(--bg-surface) !important;
            border: 1px solid var(--border-dark) !important;
            border-radius: var(--radius-lg) !important;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.02) !important;
        }

        /* Card Hover Effect */
        .zPost-item:hover,
        .bg-white:hover {
            background-color: var(--bg-elevated) !important;
            transition: all 0.25s ease;
        }

        /* Inner Cards */
        .home-item-one {
            background-color: var(--bg-elevated) !important;
            border: 1px solid var(--border-dark) !important;
            border-radius: var(--radius-md) !important;
            padding: 16px !important;
            transition: all 0.2s ease;
        }

        .home-item-one:hover {
            border-color: var(--gold) !important;
            box-shadow: 0 0 20px rgba(212, 175, 90, 0.08) !important;
        }

        .home-item-one .title,
        .home-item-one h4 {
            color: var(--text-primary) !important;
            font-weight: 600 !important;
        }

        /* ============================================
           BIO LIST ITEMS WITH GOLD ICONS
           ============================================ */
        .zList-one {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .zList-one li {
            display: flex !important;
            align-items: flex-start !important;
            padding: 12px 0 !important;
            border-bottom: 1px solid var(--border-dark) !important;
        }

        .zList-one li:last-child {
            border-bottom: none !important;
        }

        .zList-one li .bio-icon {
            color: var(--gold) !important;
            font-size: 16px !important;
            width: 24px !important;
            margin-right: 12px !important;
            flex-shrink: 0;
            text-align: center;
        }

        .zList-one li p:first-child {
            color: var(--text-primary) !important;
            font-weight: 600 !important;
            min-width: 130px !important;
            flex-shrink: 0;
        }

        .zList-one li p:last-child {
            color: var(--text-secondary) !important;
        }


        /* ============================================
           SIDEBAR (Dark Theme)
           ============================================ */
        .zSidebar {
            background-color: #0E1218 !important;
        }

        .zSidebar-menu a,
        .zSidebar-menu span {
            color: var(--text-secondary) !important;
        }

        .zSidebar-menu a:hover,
        .zSidebar-menu a.active {
            background-color: var(--bg-elevated) !important;
        }

        .zSidebar-menu a.active {
            border-left: 3px solid var(--maroon) !important;
        }

        .zSidebar-menu a.active i,
        .zSidebar-menu a.active svg {
            color: var(--gold) !important;
        }

        .zSidebar-submenu {
            background-color: #0E1218 !important;
        }

        .zSidebar-submenu a {
            color: var(--text-muted) !important;
        }

        .zSidebar-submenu a:hover {
            background-color: var(--bg-elevated) !important;
            color: var(--text-primary) !important;
        }

        .zSidebar-submenu a.active {
            color: var(--maroon) !important;
            border-left: 2px solid var(--gold) !important;
        }

        /* ============================================
           TOP NAVIGATION
           ============================================ */
        .zNav,
        .zNav-wrap {
            background-color: var(--bg-surface) !important;
            border-bottom: 1px solid var(--gold) !important;
        }

        .zNav-wrap * {
            color: var(--text-primary) !important;
        }

        /* ============================================
           BUTTONS (Dark Theme)
           ============================================ */
        /* Primary Button */
        .zBtn-one,
        button.bg-cdef84,
        .bg-cdef84,
        button[type="submit"].bg-cdef84,
        .hover-bg-one {
            background: var(--maroon) !important;
            color: #FFFFFF !important;
            border: none !important;
            border-radius: var(--radius-md) !important;
            padding: 12px 24px !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }

        .zBtn-one:hover,
        button.bg-cdef84:hover,
        .hover-bg-one:hover {
            background: var(--maroon-dark) !important;
            box-shadow: 0 0 20px rgba(212, 175, 90, 0.15) !important;
        }

        /* Active/Verified Button */
        .zBtn-one.active,
        button.zBtn-one.active {
            background: var(--success) !important;
            color: #FFFFFF !important;
        }

        /* Secondary Button */
        .btn-secondary,
        .zBtn-secondary {
            background: transparent !important;
            border: 1px solid var(--maroon) !important;
            color: var(--maroon) !important;
        }

        /* Disabled Button */
        .zBtn-one:disabled,
        button:disabled {
            background: var(--border-dark) !important;
            color: var(--text-disabled) !important;
            cursor: not-allowed !important;
        }

        /* ============================================
           FORM INPUTS (Dark Theme)
           ============================================ */
        .primary-form-control,
        .form-control,
        input.primary-form-control,
        textarea.primary-form-control,
        select.primary-form-control,
        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea,
        select {
            background: #0E1218 !important;
            border: 1px solid var(--border-dark) !important;
            border-radius: var(--radius-sm) !important;
            padding: 12px 16px !important;
            color: var(--text-primary) !important;
            font-size: 15px !important;
            height: auto !important;
            min-height: 44px !important;
            transition: all 0.2s ease !important;
        }

        .primary-form-control:focus,
        .form-control:focus,
        input:focus,
        textarea:focus,
        select:focus {
            border-color: var(--maroon) !important;
            box-shadow: 0 0 0 3px rgba(139, 38, 53, 0.2), inset 0 0 10px rgba(139, 38, 53, 0.05) !important;
            background: #0E1218 !important;
            outline: none !important;
        }

        .primary-form-control::placeholder,
        .form-control::placeholder,
        input::placeholder,
        textarea::placeholder {
            color: #6B7383 !important;
        }

        /* Form Labels */
        .form-label,
        label.form-label,
        label,
        .zForm-label,
        .control-label,
        span.form-label {
            color: var(--text-primary) !important;
            background: transparent !important;
            font-weight: 500 !important;
            font-size: 14px !important;
        }

        /* Fix white background on any text/span elements */
        .bg-white span,
        .bg-white label,
        .bg-white p,
        .zPost-item span,
        .zPost-item label,
        form span,
        form label,
        .modal span,
        .modal label {
            background: transparent !important;
        }

        /* DataTables labels and text */
        .dataTables_wrapper label,
        .dataTables_wrapper span,
        .dataTables_filter label,
        .dataTables_length label {
            color: var(--text-primary) !important;
            background: transparent !important;
        }

        /* Post Input Special */
        .postInput,
        .postCommentInput {
            background: #0E1218 !important;
            border: 1px solid var(--border-dark) !important;
        }

        .postInput:focus,
        .postCommentInput:focus {
            border-color: var(--maroon) !important;
        }

        /* ============================================
           TABS - Pill Style
           ============================================ */
        .nav-tabs.zTabHead,
        .zTabHead {
            border: none !important;
            background: var(--bg-surface) !important;
            border-radius: var(--radius-md) !important;
            padding: 6px !important;
            display: inline-flex !important;
            gap: 8px !important;
        }

        .zTabHead .nav-link {
            border: none !important;
            border-radius: var(--radius-sm) !important;
            padding: 10px 22px !important;
            color: var(--text-secondary) !important;
            font-weight: 500 !important;
            background: transparent !important;
            transition: all 0.2s ease !important;
        }

        .zTabHead .nav-link:hover {
            color: var(--text-primary) !important;
            background: var(--bg-elevated) !important;
        }

        .zTabHead .nav-link.active {
            background: var(--maroon) !important;
            color: #FFFFFF !important;
        }

        /* ============================================
           TOGGLE SWITCHES (Dark Theme)
           ============================================ */
        .form-check-input[type="checkbox"],
        .form-switch .form-check-input {
            width: 48px !important;
            height: 26px !important;
            border-radius: 26px !important;
            background-color: var(--border-dark) !important;
            border: none !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
        }

        .form-check-input:checked {
            background-color: var(--maroon) !important;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(139, 38, 53, 0.2) !important;
        }

        /* Toggle Knob */
        .form-check-input::before {
            background-color: var(--text-muted) !important;
        }

        .form-check-input:checked::before {
            background-color: #FFFFFF !important;
        }

        /* ============================================
           TABLES & LISTS (Dark Theme)
           ============================================ */
        .table,
        table,
        .dataTable,
        #DataTables_Table_0,
        .dataTables_wrapper table {
            background: var(--bg-surface) !important;
            border-radius: var(--radius-md) !important;
            overflow: hidden !important;
        }

        .table thead th,
        table thead th,
        .dataTable thead th {
            background: var(--bg-elevated) !important;
            color: var(--text-primary) !important;
            font-weight: 600 !important;
            padding: 14px 16px !important;
            border-bottom: 2px solid var(--gold) !important;
        }

        .table tbody td,
        table tbody td,
        .dataTable tbody td,
        .dataTables_wrapper tbody td {
            padding: 14px 16px !important;
            border-bottom: 1px solid var(--border-dark) !important;
            color: var(--text-primary) !important;
            background: var(--bg-surface) !important;
        }

        .table tbody tr,
        table tbody tr,
        .dataTable tbody tr {
            background: var(--bg-surface) !important;
        }

        .table tbody tr:hover td,
        table tbody tr:hover td,
        .dataTable tbody tr:hover td {
            background: var(--bg-elevated) !important;
        }

        /* DataTable specific overrides */
        .dataTables_wrapper,
        .dataTables_wrapper * {
            color: var(--text-primary) !important;
        }

        .dataTables_info {
            color: var(--text-secondary) !important;
        }

        /* Selected Row */
        .table tbody tr.selected td {
            border-left: 3px solid var(--maroon) !important;
            background: rgba(212, 175, 90, 0.05) !important;
        }

        /* ============================================
           SECURITY LIST
           ============================================ */
        .securityList {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .securityList li {
            padding: 20px 0 !important;
            border-bottom: 1px solid var(--border-dark) !important;
        }

        .securityList li:last-child {
            border-bottom: none !important;
        }

        /* ============================================
           LINKS & ACTIONS
           ============================================ */
        a {
            color: var(--gold) !important;
            transition: all 0.2s ease !important;
        }

        a:hover {
            color: var(--text-primary) !important;
        }

        a.text-decoration-underline,
        a.text-1b1c17 {
            color: var(--gold) !important;
        }

        /* ============================================
           MODALS (Dark Theme)
           ============================================ */
        .modal-content,
        .zModalOne-content {
            background-color: var(--bg-surface) !important;
            border-radius: var(--radius-lg) !important;
            border: 1px solid var(--border-dark) !important;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5) !important;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%) !important;
            color: #FFFFFF !important;
            padding: 20px 24px !important;
            border-bottom: none !important;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0 !important;
        }

        .modal-header .modal-title,
        .modal-header h4,
        .modal-header h5 {
            color: #FFFFFF !important;
            font-family: 'Playfair Display', serif !important;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1) !important;
            opacity: 0.8 !important;
        }

        .modal-body {
            padding: 24px !important;
            background-color: var(--bg-surface) !important;
            color: var(--text-primary) !important;
        }

        .modal-footer {
            background-color: var(--bg-surface) !important;
            border-top: 1px solid var(--border-dark) !important;
        }

        /* ============================================
           BADGES & PILLS
           ============================================ */
        .bg-f0f0f0,
        .rounded-pill.bg-f0f0f0 {
            background: var(--gold-light) !important;
            color: var(--gold) !important;
        }

        /* Status Badges */
        .badge-success,
        .bg-success {
            background: var(--success) !important;
        }

        .badge-warning,
        .bg-warning {
            background: var(--warning) !important;
        }

        .badge-danger,
        .bg-danger {
            background: var(--error) !important;
        }

        .badge-info,
        .bg-info {
            background: var(--info) !important;
        }

        /* ============================================
           BORDERS & DIVIDERS
           ============================================ */
        .bd-one,
        .bd-half,
        .bd-b-one,
        .bd-c-ebedf0,
        .bd-c-ededed,
        .bd-c-black-10 {
            border-color: var(--border-dark) !important;
        }

        /* Gold Divider */
        .gold-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            margin: 20px 0;
            opacity: 0.4;
        }

        /* ============================================
           AVATARS
           ============================================ */
        .bd-one.bd-c-cdef84,
        .bd-one.bd-c-ededed,
        .rounded-circle.bd-one {
            border: 2px solid var(--gold) !important;
        }

        /* ============================================
           DROPDOWN MENUS
           ============================================ */
        .dropdown-menu,
        .dropdown-menu.dropdownItem-one {
            background: var(--bg-surface) !important;
            border: 1px solid var(--border-dark) !important;
            border-radius: var(--radius-md) !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4) !important;
            padding: 8px !important;
        }

        .dropdown-menu li a,
        .dropdownItem-one li a {
            color: var(--text-secondary) !important;
            border-radius: var(--radius-sm) !important;
            padding: 10px 14px !important;
            transition: all 0.2s ease !important;
        }

        .dropdown-menu li a:hover,
        .dropdownItem-one li a:hover {
            background: var(--bg-elevated) !important;
            color: var(--text-primary) !important;
        }

        /* ============================================
           NOTIFICATIONS
           ============================================ */
        .notifyDropdown .dropdown-menu {
            min-width: 320px !important;
        }

        .notifyDropdown h4,
        .notifyDropdown .text-1b1c17 {
            color: var(--text-primary) !important;
        }

        .notifyDropdown .text-707070 {
            color: var(--text-secondary) !important;
        }

        /* Notification Badge - Gold */
        .notification-badge,
        .badge.bg-danger {
            background: var(--gold) !important;
            color: var(--bg-primary) !important;
        }

        /* ============================================
           PAGINATION
           ============================================ */
        .pagination .page-link {
            background: var(--bg-surface) !important;
            border: 1px solid var(--border-dark) !important;
            color: var(--text-secondary) !important;
            border-radius: var(--radius-sm) !important;
            margin: 0 4px !important;
        }

        .pagination .page-item.active .page-link {
            background: var(--maroon) !important;
            border-color: var(--maroon) !important;
            color: #FFFFFF !important;
        }

        .pagination .page-link:hover {
            background: var(--bg-elevated) !important;
            color: var(--text-primary) !important;
        }

        /* ============================================
           ICONS
           ============================================ */
        .text-cdef84,
        i.text-cdef84 {
            color: var(--gold) !important;
        }

        /* Invert dark icons */
        img[src*="icon/"] {
            filter: brightness(0) invert(0.7);
        }

        /* ============================================
           MICRO-INTERACTIONS & MOTION
           ============================================ */
        .zBtn-one,
        button,
        .btn,
        a,
        .bg-white,
        .zPost-item,
        .home-item-one {
            transition: all 0.2s ease !important;
        }

        .zBtn-one:hover {
            transform: scale(1.02) !important;
        }

        .zBtn-one:active,
        button:active {
            transform: scale(0.98) !important;
        }

        /* ============================================
           SCROLLBAR (Dark Theme)
           ============================================ */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-primary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-dark);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }

        /* ============================================
           RESPONSIVE ADJUSTMENTS
           ============================================ */
        @media (max-width: 768px) {
            .p-30 {
                padding: 16px !important;
            }

            .fs-24.fw-500.text-black,
            h4.fs-24 {
                font-size: 20px !important;
            }

            .zTabHead {
                flex-direction: column !important;
                width: 100% !important;
            }

            .zTabHead .nav-link {
                text-align: center !important;
            }
        }

        /* ============================================
           IMPROVED PRELOADER - Reduced Size & Animation
           ============================================ */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0B0E11 0%, #12161C 50%, #0B0E11 100%);
            z-index: 9999;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }

        #preloader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        #preloader_status {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        #preloader_status img {
            max-width: 120px !important;
            max-height: 120px !important;
            width: auto;
            height: auto;
            border-radius: 16px;
            animation: preloaderPulse 1.5s ease-in-out infinite;
            position: relative;
            z-index: 2;
        }

        /* Pulsing ring animation */
        #preloader_status::before,
        #preloader_status::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            border: 2px solid rgba(212, 175, 90, 0.3);
            animation: preloaderRing 1.5s ease-out infinite;
        }

        #preloader_status::before {
            width: 140px;
            height: 140px;
        }

        #preloader_status::after {
            width: 180px;
            height: 180px;
            animation-delay: 0.3s;
        }

        @keyframes preloaderPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(0.95);
                opacity: 0.85;
            }
        }

        @keyframes preloaderRing {
            0% {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 0.8;
            }

            100% {
                transform: translate(-50%, -50%) scale(1.3);
                opacity: 0;
            }
        }
    </style>














    @if(getOption('google_analytics_status', 0))
        <!-- Google tag (gtag.js) -->
        <script async
            src="https://www.googletagmanager.com/gtag/js?id={{ getOption('google_analytics_tracking_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', "{{ getOption('google_analytics_tracking_id') }}");
        </script>
    @endif

</head>