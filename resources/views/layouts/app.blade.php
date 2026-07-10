<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_desc', 'MaxBat Automobil — Premium ECU tuning, performance upgrades, diagnostics, exhaust systems and automotive electronics.')">
    <meta name="theme-color" content="#1C1C1C">
    <title>@yield('title', 'MaxBat Automobil — Engineered For Performance')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('storage/maxbat.jpg') }}">
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('storage/maxbat.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/maxbat.jpg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Barlow+Condensed:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --green: #5BC800;
            --green-light: rgba(91,200,0,0.12);
            --green-border: rgba(91,200,0,0.30);
            --red: #E10600;
            --bg: #FFFFFF;
            --card-bg: #1C1C1C;
            --section-dark: #161616;
            --section-alt: #1A1A1A;
            --dark: #1A1A1A;
            --gray: #5A5A5A;
            --gray2: #8A8A8A;
            --card-subtext: rgba(255,255,255,0.65);
            --border: rgba(255,255,255,0.08);
            --border-light: rgba(0,0,0,0.08);
        }
        html { scroll-behavior: smooth; overflow-x: hidden; }
        body { background: var(--bg); color: var(--dark); font-family: 'Barlow', sans-serif; font-size: 17px; line-height: 1.7; overflow-x: hidden; padding-bottom: 70px; }
        @media(min-width:1024px){ body { padding-bottom: 0; } }
        img { max-width: 100%; height: auto; display: block; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        button { cursor: pointer; border: none; background: none; font-family: inherit; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #f0f0f0; }
        ::-webkit-scrollbar-thumb { background: var(--green); border-radius: 2px; }
        .section-pad { padding: 90px 0; }
        .container { width: 100%; max-width: 1280px; margin: 0 auto; padding: 0 24px; }
        .section-label {
            display: inline-flex; align-items: center; gap: 10px;
            font-family: 'Barlow', sans-serif; font-size: 13px; font-weight: 700;
            letter-spacing: 3px; text-transform: uppercase; color: var(--green); margin-bottom: 14px;
        }
        .section-label::before { content: ''; width: 28px; height: 2px; background: var(--green); flex-shrink: 0; }
        .section-title {
            font-family: 'Bebas Neue', sans-serif; font-size: clamp(36px, 6vw, 64px);
            font-weight: 400; text-transform: uppercase; line-height: 1.05; color: #ffffff;
        }
        .section-title span { color: var(--green); }
        .section-title.dark { color: var(--dark); }
        .section-desc { color: var(--card-subtext); max-width: 580px; font-size: 17px; line-height: 1.75; margin-top: 16px; font-weight: 300; }
        .section-desc.dark { color: var(--gray); }
        .btn {
            display: inline-flex; align-items: center; gap: 10px; padding: 15px 34px;
            border-radius: 5px; font-family: 'Barlow', sans-serif; font-size: 15px;
            font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; transition: all 0.3s ease;
        }
        .btn-primary { background: var(--green); color: #000; }
        .btn-primary:hover { background: #68e000; transform: translateY(-2px); box-shadow: 0 8px 28px rgba(91,200,0,0.28); }
        .btn-outline { background: transparent; color: var(--dark); border: 2px solid rgba(0,0,0,0.18); }
        .btn-outline:hover { border-color: var(--green); color: var(--green); transform: translateY(-2px); }
        .btn-outline-light { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.25); }
        .btn-outline-light:hover { border-color: var(--green); color: var(--green); transform: translateY(-2px); }
        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-40px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(40px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }

        /* PAGE HERO BANNER (non-home pages) */
        .page-hero {
            background: linear-gradient(135deg, rgba(11,11,11,0.92) 0%, rgba(22,22,22,0.85) 100%),
                        url('https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=1920&q=80') center/cover no-repeat;
            padding: 160px 0 80px;
            text-align: center;
        }
        .page-hero h1 { font-family: 'Bebas Neue', sans-serif; font-size: clamp(42px, 8vw, 80px); font-weight: 400; text-transform: uppercase; color: #fff; letter-spacing: -0.5px; }
        .page-hero h1 span { color: var(--green); }
        .page-hero p { color: rgba(255,255,255,0.65); font-size: 17px; max-width: 560px; margin: 16px auto 0; font-weight: 300; }
        .page-hero-breadcrumb { display: flex; align-items: center; justify-content: center; gap: 8px; margin-bottom: 20px; font-size: 13px; color: rgba(255,255,255,0.5); font-weight: 500; text-transform: uppercase; letter-spacing: 1px; }
        .page-hero-breadcrumb a { color: var(--green); }
        .page-hero-breadcrumb i { font-size: 10px; }

        /* NAVBAR */
        #navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            background: url('{{ asset('storage/maxbat.jpg') }}') center/cover no-repeat;
            border-bottom: 3px solid var(--green);
            box-shadow: 0 2px 20px rgba(0,0,0,0.25); transition: all 0.3s ease;
        }
        #navbar::before {
            content: ''; position: absolute; inset: 0;
            background: rgba(28,28,28,0.82);
            pointer-events: none; z-index: 0;
        }
        #navbar.scrolled::before { background: rgba(22,22,22,0.90); }
        #navbar > * { position: relative; z-index: 1; }
        .nav-inner { position: relative; z-index: 1; }
        .nav-inner { display: flex; align-items: center; justify-content: space-between; height: 80px; }
        .nav-logo { display: flex; align-items: center; }
        .nav-logo img { object-fit: contain; height: 52px; width: auto; border-radius: 6px; }
        .nav-links { display: none; gap: 2px; }
        .nav-links a {
            padding: 10px 18px; font-family: 'Barlow', sans-serif; font-size: 16px; font-weight: 700;
            letter-spacing: 0.5px; text-transform: uppercase; color: rgba(255,255,255,0.75);
            transition: color 0.2s, background 0.2s; border-radius: 5px;
        }
        .nav-links a:hover, .nav-links a.active { color: var(--green); background: rgba(91,200,0,0.08); }
        .nav-actions { display: flex; align-items: center; gap: 12px; }
        .hamburger {
            width: 46px; height: 46px; display: flex; flex-direction: column;
            justify-content: center; align-items: center; gap: 5px;
            background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12);
            border-radius: 6px; cursor: pointer;
        }
        .hamburger span { width: 22px; height: 2px; background: #fff; transition: all 0.3s ease; display: block; }
        .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }
        @media(min-width:1024px){ .nav-links { display: flex; } .hamburger { display: none; } }

        /* MOBILE MENU */
        .mobile-menu {
            position: fixed; inset: 0; z-index: 999;
            background: rgba(10,10,10,0.98); backdrop-filter: blur(30px);
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            transform: translateX(100%); transition: transform 0.4s cubic-bezier(0.77,0,0.175,1);
        }
        .mobile-menu.open { transform: translateX(0); }
        .mobile-menu a {
            font-family: 'Bebas Neue', sans-serif; font-size: 22px; font-weight: 400;
            text-transform: uppercase; letter-spacing: 2px; color: #fff;
            padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.08);
            width: 80%; text-align: center; transition: color 0.3s;
        }
        .mobile-menu a:hover, .mobile-menu a.active { color: var(--green); }
        .mobile-menu-footer { position: absolute; bottom: 40px; display: flex; gap: 20px; }
        .mobile-menu-footer a {
            font-size: 20px !important; width: 44px; height: 44px; border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.15) !important;
            display: flex; align-items: center; justify-content: center;
            padding: 0 !important; color: #fff !important;
        }

        /* FOOTER */
        footer { background: #0e0e0e; border-top: 1px solid rgba(255,255,255,0.06); padding: 60px 0 0; }
        .footer-grid {
            display: grid; grid-template-columns: 1fr;
            gap: 40px; padding-bottom: 40px; border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        @media(min-width:640px){ .footer-grid { grid-template-columns: repeat(2,1fr); } }
        @media(min-width:1024px){ .footer-grid { grid-template-columns: 2fr 1fr 1fr 1fr 1.5fr; } }
        .footer-brand p { color: rgba(255,255,255,0.5); font-size: 14px; line-height: 1.7; margin: 16px 0 24px; max-width: 280px; }
        .social-links { display: flex; gap: 10px; }
        .social-link {
            width: 38px; height: 38px; border-radius: 6px;
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.10);
            display: flex; align-items: center; justify-content: center;
            color: #aaa; font-size: 15px; transition: all 0.3s;
        }
        .social-link:hover { background: var(--green); color: #000; border-color: var(--green); }
        .footer-col h4 { font-family: 'Barlow', sans-serif; font-size: 15px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #fff; margin-bottom: 16px; }
        .footer-col ul { display: flex; flex-direction: column; gap: 8px; }
        .footer-col ul li a { color: #aaa; font-size: 15px; transition: color 0.3s; font-family: 'Barlow', sans-serif; }
        .footer-col ul li a:hover { color: var(--green); }
        .newsletter-form { display: flex; gap: 8px; margin-top: 16px; }
        .newsletter-input {
            flex: 1; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.10);
            color: #fff; padding: 12px 16px; border-radius: 6px; font-family: 'Barlow', sans-serif; font-size: 14px;
        }
        .newsletter-input:focus { outline: none; border-color: var(--green); }
        .newsletter-input::placeholder { color: #555; }
        .newsletter-btn {
            background: var(--green); color: #000; padding: 12px 16px; border-radius: 6px;
            font-family: 'Barlow', sans-serif; font-weight: 700; font-size: 14px; text-transform: uppercase; transition: background 0.3s; white-space: nowrap;
        }
        .newsletter-btn:hover { background: #68e000; }
        .footer-bottom {
            padding: 20px 0; display: flex; flex-direction: column; gap: 8px; align-items: center; text-align: center;
        }
        .footer-bottom p { color: #555; font-size: 13px; }
        .footer-bottom a { color: var(--green); }
        @media(min-width:1024px){ .footer-bottom { flex-direction: row; justify-content: space-between; text-align: left; } }

        /* MOBILE BOTTOM BAR */
        .mobile-bottom-bar {
            position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
            background: rgba(10,10,10,0.97); backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255,255,255,0.08); padding: 10px 16px; display: flex; gap: 8px;
        }
        .mobile-bottom-bar a {
            flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 3px;
            font-family: 'Barlow', sans-serif; font-size: 10px; font-weight: 700; text-transform: uppercase;
            color: #aaa; padding: 8px; border-radius: 6px; transition: all 0.2s;
        }
        .mobile-bottom-bar a i { font-size: 18px; }
        .mobile-bottom-bar a:hover, .mobile-bottom-bar a.active { color: var(--green); }
        @media(min-width:1024px){ .mobile-bottom-bar { display: none; } }

        /* WHATSAPP FAB — desktop only */
        .whatsapp-fab {
            position: fixed; bottom: 80px; right: 20px; z-index: 997;
            width: 52px; height: 52px; border-radius: 50%;
            background: #25D366; color: #fff;
            display: none;
            align-items: center; justify-content: center;
            font-size: 24px; box-shadow: 0 4px 20px rgba(37,211,102,0.4); transition: all 0.3s;
        }
        .whatsapp-fab:hover { transform: scale(1.1); }
        .telegram-fab {
            position: fixed; bottom: 142px; right: 20px; z-index: 997;
            width: 52px; height: 52px; border-radius: 50%;
            background: #229ED9; color: #fff;
            display: none;
            align-items: center; justify-content: center;
            font-size: 24px; box-shadow: 0 4px 20px rgba(34,158,217,0.4); transition: all 0.3s;
        }
        .telegram-fab:hover { transform: scale(1.1); }
        @media(min-width:1024px){
            .whatsapp-fab { display: flex; bottom: 30px; }
            .telegram-fab { display: flex; bottom: 92px; }
        }

        /* CHAT FAB */
        .chat-fab {
            position: fixed; right: 20px; z-index: 997;
            width: 52px; height: 52px; border-radius: 50%;
            background: var(--green); color: #000; border: none;
            display: none; align-items: center; justify-content: center;
            font-size: 22px; box-shadow: 0 4px 20px rgba(91,200,0,0.4);
            cursor: pointer; transition: all 0.3s;
            bottom: 204px;
        }
        .chat-fab:hover { transform: scale(1.1); background: #68e000; }
        .chat-fab .chat-fab-badge {
            position: absolute; top: -3px; right: -3px;
            background: #E10600; color: #fff; border-radius: 50%;
            width: 18px; height: 18px; font-size: 10px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid #0f0f0f;
        }
        @media(min-width:1024px){ .chat-fab { display: flex; bottom: 154px; } }
        /* on mobile show in bottom bar area */
        @media(max-width:1023px){ .chat-fab { display: flex; bottom: 80px; width: 46px; height: 46px; font-size: 19px; } }

        /* CHAT PANE */
        .chat-pane {
            position: fixed; top: 0; right: 0; bottom: 0; z-index: 1200;
            width: min(33vw, 420px); min-width: 320px;
            background: #111; border-left: 1px solid rgba(255,255,255,0.08);
            display: flex; flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
            box-shadow: -8px 0 40px rgba(0,0,0,0.5);
            resize: horizontal; overflow: auto;
        }
        .chat-pane.open { transform: translateX(0); }
        @media(max-width:640px){ .chat-pane { width: 100vw !important; min-width: unset; } }

        .chat-pane-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 18px; border-bottom: 1px solid rgba(255,255,255,0.07);
            background: #161616; flex-shrink: 0;
        }
        .chat-pane-title { display: flex; align-items: center; gap: 10px; }
        .chat-pane-title-icon {
            width: 36px; height: 36px; border-radius: 50%;
            background: rgba(91,200,0,0.12); border: 1px solid rgba(91,200,0,0.25);
            display: flex; align-items: center; justify-content: center;
            color: var(--green); font-size: 15px; flex-shrink: 0;
        }
        .chat-pane-title-text .name { font-family: 'Bebas Neue', sans-serif; font-size: 17px; color: #fff; letter-spacing: 1px; text-transform: uppercase; }
        .chat-pane-title-text .sub { font-size: 11px; color: rgba(255,255,255,0.4); margin-top: 1px; display: flex; align-items: center; gap: 5px; }
        .chat-pane-online { width: 7px; height: 7px; background: var(--green); border-radius: 50%; animation: cpulse 2s infinite; }
        @keyframes cpulse { 0%,100%{opacity:1} 50%{opacity:0.3} }
        .chat-pane-close {
            width: 34px; height: 34px; border-radius: 50%; background: rgba(255,255,255,0.06);
            border: none; color: #fff; font-size: 15px; cursor: pointer;
            display: flex; align-items: center; justify-content: center; transition: background 0.2s; flex-shrink: 0;
        }
        .chat-pane-close:hover { background: rgba(225,6,0,0.2); color: #ff6b6b; }

        .chat-pane-messages {
            flex: 1; overflow-y: auto; padding: 16px; display: flex;
            flex-direction: column; gap: 10px; scroll-behavior: smooth;
        }
        .chat-pane-messages::-webkit-scrollbar { width: 3px; }
        .chat-pane-messages::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 2px; }

        .cp-msg { display: flex; flex-direction: column; max-width: 80%; }
        .cp-msg.mine { align-self: flex-end; align-items: flex-end; }
        .cp-msg.theirs { align-self: flex-start; align-items: flex-start; }
        .cp-bubble { padding: 9px 13px; border-radius: 12px; font-size: 13px; line-height: 1.55; word-break: break-word; font-family: 'Barlow', sans-serif; }
        .cp-msg.mine .cp-bubble { background: var(--green); color: #000; border-bottom-right-radius: 3px; }
        .cp-msg.theirs .cp-bubble { background: #252525; color: #fff; border-bottom-left-radius: 3px; }
        .cp-meta { font-size: 10px; color: rgba(255,255,255,0.3); margin-top: 3px; padding: 0 2px; }

        .cp-empty { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 32px; color: rgba(255,255,255,0.3); }
        .cp-empty i { font-size: 36px; margin-bottom: 12px; opacity: 0.3; display: block; }
        .cp-empty p { font-size: 13px; line-height: 1.6; }

        .chat-pane-input {
            padding: 12px 14px; border-top: 1px solid rgba(255,255,255,0.07);
            display: flex; gap: 8px; align-items: flex-end; flex-shrink: 0; background: #161616;
        }
        .cp-textarea {
            flex: 1; background: #252525; border: 1px solid rgba(255,255,255,0.10);
            color: #fff; padding: 10px 13px; border-radius: 8px;
            font-family: 'Barlow', sans-serif; font-size: 13px;
            resize: none; min-height: 40px; max-height: 100px; overflow-y: auto;
            transition: border-color 0.2s; line-height: 1.5;
        }
        .cp-textarea:focus { outline: none; border-color: var(--green); }
        .cp-textarea::placeholder { color: rgba(255,255,255,0.2); }
        .cp-send-btn {
            width: 40px; height: 40px; border-radius: 8px; background: var(--green);
            border: none; color: #000; font-size: 15px; cursor: pointer;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: background 0.2s;
        }
        .cp-send-btn:hover { background: #68e000; }
        .cp-send-btn:disabled { background: #333; color: #555; cursor: not-allowed; }

        /* Login prompt inside pane */
        .cp-login-prompt { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 32px; gap: 16px; }
        .cp-login-prompt i { font-size: 42px; color: var(--green); }
        .cp-login-prompt h3 { font-family: 'Bebas Neue', sans-serif; font-size: 22px; color: #fff; letter-spacing: 1px; text-transform: uppercase; }
        .cp-login-prompt p { font-size: 13px; color: rgba(255,255,255,0.5); line-height: 1.6; }
        .cp-login-prompt a { display: inline-flex; align-items: center; gap: 8px; padding: 11px 24px; background: var(--green); color: #000; border-radius: 7px; font-family: 'Barlow', sans-serif; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-decoration: none; transition: background 0.2s; }
        .cp-login-prompt a:hover { background: #68e000; }

        /* Overlay behind pane on mobile */
        .chat-pane-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1199; }
        .chat-pane-overlay.open { display: block; }

        .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
    </style>
    @stack('styles')
</head>
<body>

{{-- NAVBAR --}}
<nav id="navbar" aria-label="Main navigation">
    <div class="container">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-logo" aria-label="MaxBat Automobil home">
                <img src="{{ asset('storage/maxbat.jpg') }}" alt="MaxBat Automobil Logo">
            </a>
            <div class="nav-links" role="menubar">
                <a href="{{ route('home') }}"     role="menuitem" class="{{ request()->routeIs('home')     ? 'active' : '' }}">Home</a>
                <a href="{{ route('services') }}" role="menuitem" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
                <a href="{{ route('products') }}" role="menuitem" class="{{ request()->routeIs('products') ? 'active' : '' }}">Products</a>
                <a href="{{ route('cars_for_sale') }}" role="menuitem" class="{{ request()->routeIs('cars_for_sale*') ? 'active' : '' }}">Cars for Sale</a>
                <a href="{{ route('videos') }}"   role="menuitem" class="{{ request()->routeIs('videos')   ? 'active' : '' }}">Videos</a>
                <a href="#" role="menuitem" onclick="showComingSoon(event)">Projects</a>
                <a href="{{ route('careers') }}"  role="menuitem" class="{{ request()->routeIs('careers')  ? 'active' : '' }}">Careers</a>
                <a href="{{ route('about') }}"    role="menuitem" class="{{ request()->routeIs('about')    ? 'active' : '' }}">About</a>
                <a href="{{ route('contact') }}"  role="menuitem" class="{{ request()->routeIs('contact')  ? 'active' : '' }}">Contact</a>
            </div>
            <div class="nav-actions">
                {{-- CART ICON — visible to everyone --}}
                <button id="cartFabNavBtn" onclick="openCartPane()" aria-label="Open cart"
                    style="position:relative;background:none;border:none;color:#fff;font-size:20px;cursor:pointer;padding:6px;display:flex;align-items:center;justify-content:center;transition:color 0.2s;"
                    onmouseover="this.style.color='var(--green)'" onmouseout="this.style.color='#fff'">
                    <i class="fa fa-shopping-cart"></i>
                    <span id="cartBadgeNav" style="display:none;position:absolute;top:-4px;right:-4px;background:var(--green);color:#000;border-radius:50%;width:18px;height:18px;font-size:10px;font-weight:700;align-items:center;justify-content:center;border:2px solid #1C1C1C;"></span>
                </button>

                @auth
                    @if(!auth()->user()->isAdmin())
                    {{-- Logged-in customer --}}
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);color:#fff;padding:8px 14px;border-radius:5px;font-family:'Barlow',sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;cursor:pointer;display:flex;align-items:center;gap:6px;transition:background 0.2s;"
                            onmouseover="this.style.background='rgba(225,6,0,0.15)';this.style.color='#ff6b6b';"
                            onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='#fff';">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                    @endif
                @else
                    <button onclick="openAuthModal('login')" class="btn btn-outline-light" style="padding:8px 16px;font-size:13px;">
                        <i class="fa fa-sign-in-alt"></i> Sign In
                    </button>
                @endauth

                <button class="hamburger" id="hamburgerBtn" aria-label="Toggle mobile menu" aria-expanded="false" aria-controls="mobileMenu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </div>
</nav>

{{-- MOBILE MENU --}}
<div class="mobile-menu" id="mobileMenu" role="dialog" aria-modal="true" aria-label="Mobile navigation">
    <a href="{{ route('home') }}"     class="mobile-nav-link {{ request()->routeIs('home')     ? 'active' : '' }}">Home</a>
    <a href="{{ route('services') }}" class="mobile-nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
    <a href="{{ route('products') }}" class="mobile-nav-link {{ request()->routeIs('products') ? 'active' : '' }}">Products</a>
    <a href="{{ route('cars_for_sale') }}" class="mobile-nav-link {{ request()->routeIs('cars_for_sale*') ? 'active' : '' }}">Cars for Sale</a>
    <a href="{{ route('videos') }}"   class="mobile-nav-link {{ request()->routeIs('videos')   ? 'active' : '' }}">Videos</a>
    <a href="#" class="mobile-nav-link" onclick="showComingSoon(event)">Projects</a>
    <a href="{{ route('careers') }}"  class="mobile-nav-link {{ request()->routeIs('careers')  ? 'active' : '' }}">Careers</a>
    <a href="{{ route('about') }}"    class="mobile-nav-link {{ request()->routeIs('about')    ? 'active' : '' }}">About</a>
    <a href="{{ route('contact') }}"  class="mobile-nav-link {{ request()->routeIs('contact')  ? 'active' : '' }}">Contact</a>
    <div class="mobile-menu-footer">
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        <a href="https://wa.me/256701244403" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
    </div>
</div>

{{-- PAGE CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
<footer role="contentinfo" style="
    background: url('{{ asset('storage/maxbat.jpg') }}') center/cover no-repeat;
    position: relative;
">
    <div aria-hidden="true" style="position:absolute;inset:0;background:rgba(10,10,10,0.92);pointer-events:none;"></div>
    <div class="container" style="position:relative;z-index:1;">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('storage/maxbat.jpg') }}" alt="MaxBat Automobil" style="height:48px;width:auto;border-radius:6px;">
                </a>
                <p>Engineered for performance. Trusted by enthusiasts and professionals across the region since 2009.</p>
                <div class="social-links">
                    <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-link" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    <a href="https://wa.me/256701244403" class="social-link" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://t.me/256701244403" class="social-link" aria-label="Telegram" target="_blank" rel="noopener noreferrer"><i class="fab fa-telegram-plane"></i></a>
                </div>
            </div>
            <nav class="footer-col" aria-label="Services">
                <h4>Services</h4>
                <ul>
                    <li><a href="{{ route('services') }}">ECU Tuning</a></li>
                    <li><a href="{{ route('services') }}">Vehicle Diagnostics</a></li>
                    <li><a href="{{ route('services') }}">Performance Upgrades</a></li>
                    <li><a href="{{ route('services') }}">Turbo Systems</a></li>
                    <li><a href="{{ route('services') }}">Exhaust Systems</a></li>
                    <li><a href="{{ route('services') }}">Auto Electronics</a></li>
                    <li><a href="{{ route('services') }}">Maintenance</a></li>
                    <li><a href="{{ route('services') }}">Fleet Solutions</a></li>
                </ul>
            </nav>
            <nav class="footer-col" aria-label="Quick links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products') }}">Products</a></li>
                    <li><a href="{{ route('cars_for_sale') }}">Cars for Sale</a></li>
                    <li><a href="{{ route('videos') }}">Videos</a></li>
                    <li><a href="#" onclick="showComingSoon(event)">Projects</a></li>
                    <li><a href="{{ route('careers') }}">Careers</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </nav>
            <div class="footer-col">
                <h4>Contact</h4>
                <ul>
                    <li style="color:#aaa;font-size:14px;padding:4px 0;display:flex;gap:8px;align-items:flex-start;"><i class="fa fa-map-marker-alt" style="color:var(--green);margin-top:3px;"></i>Industrijska bb, Belgrade</li>
                    <li><a href="tel:+256703560021" style="display:flex;align-items:center;gap:8px;padding:4px 0;"><i class="fa fa-phone" style="color:var(--green);"></i>+256 703 560 021</a></li>
                    <li><a href="tel:+256784425788" style="display:flex;align-items:center;gap:8px;padding:4px 0;"><i class="fa fa-phone" style="color:var(--green);"></i>+256 784 425 788</a></li>
                    <li><a href="mailto:info@maxbat.rs" style="display:flex;align-items:center;gap:8px;padding:4px 0;"><i class="fa fa-envelope" style="color:var(--green);"></i>info@maxbat.rs</a></li>
                    <li style="color:#aaa;font-size:14px;padding:4px 0;display:flex;gap:8px;align-items:flex-start;margin-top:4px;"><i class="fa fa-clock" style="color:var(--green);margin-top:3px;"></i>Mon–Fri 08–18h · Sat 09–14h</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Newsletter</h4>
                <p style="color:#aaa;font-size:14px;line-height:1.6;">Get performance tips, new product alerts, and exclusive offers.</p>
                <form class="newsletter-form" onsubmit="return false;">
                    <label for="newsletterEmail" class="sr-only">Email address</label>
                    <input type="email" id="newsletterEmail" class="newsletter-input" placeholder="your@email.com" autocomplete="email">
                    <button type="submit" class="newsletter-btn">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} MaxBat Automobil. All rights reserved.</p>
            <p><a href="#">Privacy Policy</a> · <a href="#">Terms of Service</a></p>
        </div>
    </div>
</footer>

{{-- MOBILE BOTTOM BAR --}}
<nav class="mobile-bottom-bar" aria-label="Mobile quick actions">
    <a href="tel:+256703560021" aria-label="Call us"><i class="fa fa-phone"></i><span>Call</span></a>
    <a href="https://wa.me/256701244403" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i><span>WhatsApp</span></a>
    <a href="https://t.me/256701244403" target="_blank" rel="noopener noreferrer" aria-label="Telegram"><i class="fab fa-telegram-plane"></i><span>Telegram</span></a>
    <a href="{{ route('products') }}" aria-label="Shop products" class="{{ request()->routeIs('products') ? 'active' : '' }}"><i class="fa fa-shopping-cart"></i><span>Shop</span></a>
    <a href="{{ route('home') }}" aria-label="Home" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="fa fa-home"></i><span>Home</span></a>
</nav>

{{-- TELEGRAM FAB (desktop only) --}}
<a href="https://t.me/256701244403" class="telegram-fab" target="_blank" rel="noopener noreferrer" aria-label="Open Telegram chat">
    <i class="fab fa-telegram-plane"></i>
</a>

{{-- WHATSAPP FAB (desktop only) --}}
<a href="https://wa.me/256701244403" class="whatsapp-fab" target="_blank" rel="noopener noreferrer" aria-label="Open WhatsApp chat">
    <i class="fab fa-whatsapp"></i>
</a>

{{-- CHAT FAB (logged-in customers only) --}}
@auth
@if(!auth()->user()->isAdmin())
<button class="chat-fab" id="chatFabBtn" aria-label="Open support chat">
    <i class="fa fa-comments"></i>
</button>
@endif
@else
<button class="chat-fab" id="chatFabBtn" aria-label="Open support chat">
    <i class="fa fa-comments"></i>
</button>
@endauth

{{-- CHAT PANE OVERLAY --}}
<div class="chat-pane-overlay" id="chatPaneOverlay" onclick="closeChatPane()"></div>

{{-- CHAT PANE --}}
<aside class="chat-pane" id="chatPane" aria-label="Support chat">

    <div class="chat-pane-header">
        <div class="chat-pane-title">
            <div class="chat-pane-title-icon"><i class="fa fa-headset"></i></div>
            <div class="chat-pane-title-text">
                <div class="name">MaxBat Support</div>
                <div class="sub"><span class="chat-pane-online"></span> Online · replies within hours</div>
            </div>
        </div>
        <button class="chat-pane-close" onclick="closeChatPane()" aria-label="Close chat">✕</button>
    </div>

    {{-- Content injected by JS --}}
    <div id="chatPaneBody" style="flex:1;display:flex;flex-direction:column;overflow:hidden;"></div>

</aside>

<script>
(function() {
    const fab     = document.getElementById('chatFabBtn');
    const pane    = document.getElementById('chatPane');
    const overlay = document.getElementById('chatPaneOverlay');
    const body    = document.getElementById('chatPaneBody');

    @php $isCust = auth()->check() && !auth()->user()->isAdmin(); @endphp
    const IS_AUTH  = {{ $isCust ? 'true' : 'false' }};
    const SEND_URL = '{{ $isCust ? route("customer.chat.send") : "#" }}';
    const POLL_URL = '{{ $isCust ? route("customer.chat.poll") : "#" }}';
    const CSRF     = '{{ csrf_token() }}';
    const LOGIN_URL    = '{{ route("login") }}';
    const REGISTER_URL = '{{ route("register") }}';

    let lastId    = 0;
    let pollTimer = null;
    let loaded    = false;

    window.closeChatPane = function() {
        pane.classList.remove('open');
        overlay.classList.remove('open');
        clearInterval(pollTimer);
    };

    if (fab) {
        fab.addEventListener('click', () => {
            const isOpen = pane.classList.toggle('open');
            overlay.classList.toggle('open', isOpen);
            if (isOpen) {
                if (!loaded) { loaded = true; initPane(); }
                else scrollToBottom();
                if (IS_AUTH) startPolling();
            } else {
                clearInterval(pollTimer);
            }
        });
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeChatPane();
    });

    function scrollToBottom() {
        const msgs = document.getElementById('cpMessages');
        if (msgs) msgs.scrollTop = msgs.scrollHeight;
    }

    function escHtml(s) {
        return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    function renderMessage(msg) {
        const isMine = msg.sender_type === 'customer';
        return `<div class="cp-msg ${isMine ? 'mine' : 'theirs'}" data-id="${msg.id}">
            <div class="cp-bubble">${escHtml(msg.body)}</div>
            <div class="cp-meta">${escHtml(msg.date)}, ${escHtml(msg.time)}</div>
        </div>`;
    }

    function appendMessage(msg) {
        const msgs = document.getElementById('cpMessages');
        if (!msgs) return;
        const empty = msgs.querySelector('.cp-empty');
        if (empty) empty.remove();
        msgs.insertAdjacentHTML('beforeend', renderMessage(msg));
        lastId = Math.max(lastId, msg.id);
        scrollToBottom();
    }

    async function loadHistory() {
        try {
            const res  = await fetch(`${POLL_URL}?since=0`, { headers: {'X-Requested-With':'XMLHttpRequest'} });
            const msgs = await res.json();
            const container = document.getElementById('cpMessages');
            if (!container) return;
            if (msgs.length === 0) {
                container.innerHTML = `<div class="cp-empty"><i class="fa fa-comments"></i><p>No messages yet.<br>Say hello — we'll get back to you shortly!</p></div>`;
            } else {
                container.innerHTML = msgs.map(renderMessage).join('');
                lastId = Math.max(...msgs.map(m => m.id));
            }
            scrollToBottom();
        } catch(e) {}
    }

    async function sendMessage() {
        const input = document.getElementById('cpInput');
        const btn   = document.getElementById('cpSendBtn');
        if (!input || !btn) return;
        const body = input.value.trim();
        if (!body) return;
        btn.disabled = true;
        input.value  = '';
        input.style.height = 'auto';
        try {
            const res = await fetch(SEND_URL, {
                method:  'POST',
                headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': CSRF, 'X-Requested-With':'XMLHttpRequest' },
                body:    JSON.stringify({ body })
            });
            const msg = await res.json();
            if (msg.id) appendMessage(msg);
        } catch(e) { input.value = body; }
        finally { btn.disabled = false; input.focus(); }
    }

    async function poll() {
        try {
            const res  = await fetch(`${POLL_URL}?since=${lastId}`, { headers:{'X-Requested-With':'XMLHttpRequest'} });
            const msgs = await res.json();
            msgs.forEach(m => appendMessage(m));
        } catch(e) {}
    }

    function startPolling() {
        clearInterval(pollTimer);
        pollTimer = setInterval(poll, 4000);
    }

    function initPane() {
        if (!IS_AUTH) {
            // Not logged in — show login prompt
            body.innerHTML = `
                <div class="cp-login-prompt">
                    <i class="fa fa-lock"></i>
                    <h3>Sign In to Chat</h3>
                    <p>Create a free account or sign in to chat directly with our team.</p>
                    <button onclick="openAuthModal('login')" style="display:inline-flex;align-items:center;gap:8px;padding:11px 24px;background:var(--green);color:#000;border:none;border-radius:7px;font-family:Barlow,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;cursor:pointer;"><i class="fa fa-sign-in-alt"></i> Sign In</button>
                    <button onclick="openAuthModal('register')" style="display:inline-flex;align-items:center;gap:8px;padding:11px 24px;background:transparent;border:1px solid rgba(91,200,0,0.3);color:var(--green);border-radius:7px;font-family:Barlow,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;cursor:pointer;margin-top:6px;"><i class="fa fa-user-plus"></i> Create Account</button>
                </div>`;
            return;
        }

        // Logged in — show chat UI
        body.innerHTML = `
            <div class="chat-pane-messages" id="cpMessages">
                <div class="cp-empty"><i class="fa fa-spinner fa-spin"></i><p>Loading…</p></div>
            </div>
            <div class="chat-pane-input">
                <textarea id="cpInput" class="cp-textarea" placeholder="Type a message…" rows="1" maxlength="2000"></textarea>
                <button id="cpSendBtn" class="cp-send-btn" title="Send"><i class="fa fa-paper-plane"></i></button>
            </div>`;

        loadHistory();
        startPolling();

        document.getElementById('cpSendBtn').addEventListener('click', sendMessage);
        document.getElementById('cpInput').addEventListener('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
        });
        document.getElementById('cpInput').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        });
    }
})();
</script>

<script>
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 60);
}, { passive: true });

const hamburger = document.getElementById('hamburgerBtn');
const mobileMenu = document.getElementById('mobileMenu');
hamburger.addEventListener('click', () => {
    const isOpen = mobileMenu.classList.toggle('open');
    hamburger.classList.toggle('active');
    hamburger.setAttribute('aria-expanded', isOpen);
    document.body.style.overflow = isOpen ? 'hidden' : '';
});
document.querySelectorAll('.mobile-nav-link').forEach(link => {
    link.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
        hamburger.classList.remove('active');
        hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    });
});

// Scroll reveal
const revealObserver = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => revealObserver.observe(el));
</script>
{{-- CART PANE OVERLAY --}}
<div class="cart-pane-overlay" id="cartPaneOverlay" onclick="closeCartPane()"></div>

{{-- CART PANE --}}
<aside class="cart-pane" id="cartPane" aria-label="Shopping cart">
    <div class="cart-pane-header">
        <div style="display:flex;align-items:center;gap:10px;">
            <i class="fa fa-shopping-cart" style="color:var(--green);font-size:18px;"></i>
            <span style="font-family:'Bebas Neue',sans-serif;font-size:18px;color:#fff;letter-spacing:1px;text-transform:uppercase;">Your Cart</span>
            <span id="cartPaneCount" style="background:var(--green);color:#000;border-radius:100px;padding:2px 9px;font-size:11px;font-weight:700;"></span>
        </div>
        <button class="cart-pane-close" onclick="closeCartPane()" aria-label="Close cart">✕</button>
    </div>
    <div id="cartPaneBody" style="flex:1;display:flex;flex-direction:column;overflow:hidden;"></div>
</aside>

<style>
/* CART PANE */
.cart-pane-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:1198;}
.cart-pane-overlay.open{display:block;}
.cart-pane{
    position:fixed;top:0;right:0;bottom:0;z-index:1199;
    width:min(33vw,420px);min-width:320px;
    background:#111;border-left:1px solid rgba(255,255,255,0.08);
    display:flex;flex-direction:column;
    transform:translateX(100%);
    transition:transform 0.35s cubic-bezier(0.4,0,0.2,1);
    box-shadow:-8px 0 40px rgba(0,0,0,0.5);
}
.cart-pane.open{transform:translateX(0);}
@media(max-width:640px){.cart-pane{width:100vw!important;min-width:unset;}}
.cart-pane-header{display:flex;align-items:center;justify-content:space-between;padding:16px 18px;border-bottom:1px solid rgba(255,255,255,0.07);background:#161616;flex-shrink:0;}
.cart-pane-close{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.06);border:none;color:#fff;font-size:15px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.2s;flex-shrink:0;}
.cart-pane-close:hover{background:rgba(225,6,0,0.2);color:#ff6b6b;}

/* CART ITEMS */
.cart-items{flex:1;overflow-y:auto;padding:14px;}
.cart-items::-webkit-scrollbar{width:3px;}
.cart-items::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.08);border-radius:2px;}
.cart-item{display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid rgba(255,255,255,0.06);}
.cart-item:last-child{border-bottom:none;}
.cart-item-img{width:52px;height:52px;border-radius:7px;object-fit:cover;background:#222;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.2);font-size:20px;}
.cart-item-info{flex:1;min-width:0;}
.cart-item-name{font-weight:600;color:#fff;font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.cart-item-price{font-family:'Bebas Neue',sans-serif;font-size:17px;color:var(--green);margin-top:2px;}
.cart-item-qty{display:flex;align-items:center;gap:6px;margin-top:6px;}
.qty-btn{width:24px;height:24px;border-radius:5px;background:rgba(255,255,255,0.08);border:none;color:#fff;font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.2s;}
.qty-btn:hover{background:rgba(91,200,0,0.2);color:var(--green);}
.qty-val{min-width:22px;text-align:center;font-size:13px;color:#fff;}
.cart-item-remove{background:none;border:none;color:rgba(255,255,255,0.25);cursor:pointer;font-size:14px;padding:4px;transition:color 0.2s;flex-shrink:0;}
.cart-item-remove:hover{color:#ff6b6b;}

/* EMPTY STATE */
.cart-empty{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:32px;color:rgba(255,255,255,0.3);}
.cart-empty i{font-size:48px;margin-bottom:14px;opacity:0.2;display:block;}
.cart-empty p{font-size:13px;line-height:1.6;}

/* FOOTER */
.cart-footer{padding:14px 16px;border-top:1px solid rgba(255,255,255,0.07);background:#161616;flex-shrink:0;}
.cart-total-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;}
.cart-total-label{font-size:12px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:rgba(255,255,255,0.45);}
.cart-total-val{font-family:'Bebas Neue',sans-serif;font-size:26px;color:var(--green);}
.cart-checkout-btn{width:100%;padding:13px;background:var(--green);color:#000;border:none;border-radius:8px;font-family:'Barlow',sans-serif;font-size:14px;font-weight:700;text-transform:uppercase;letter-spacing:1px;cursor:pointer;transition:background 0.2s;display:flex;align-items:center;justify-content:center;gap:8px;}
.cart-checkout-btn:hover{background:#68e000;}
.cart-checkout-btn:disabled{background:#333;color:#666;cursor:not-allowed;}
.cart-clear-btn{width:100%;margin-top:8px;padding:9px;background:transparent;border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.4);border-radius:7px;font-family:'Barlow',sans-serif;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;cursor:pointer;transition:all 0.2s;}
.cart-clear-btn:hover{border-color:rgba(225,6,0,0.3);color:#ff6b6b;}

/* Notes input */
.cart-notes{width:100%;background:#252525;border:1px solid rgba(255,255,255,0.10);color:#fff;padding:9px 12px;border-radius:7px;font-family:'Barlow',sans-serif;font-size:13px;resize:none;margin-bottom:10px;transition:border-color 0.2s;}
.cart-notes:focus{outline:none;border-color:var(--green);}
.cart-notes::placeholder{color:rgba(255,255,255,0.2);}

/* Login prompt in cart */
.cart-login-prompt{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:28px;gap:14px;}
.cart-login-prompt i{font-size:44px;color:var(--green);}
.cart-login-prompt h3{font-family:'Bebas Neue',sans-serif;font-size:22px;color:#fff;letter-spacing:1px;text-transform:uppercase;}
.cart-login-prompt p{font-size:13px;color:rgba(255,255,255,0.5);line-height:1.6;}
.cart-login-prompt a{display:inline-flex;align-items:center;gap:8px;padding:11px 22px;background:var(--green);color:#000;border-radius:7px;font-family:'Barlow',sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;text-decoration:none;transition:background 0.2s;}
.cart-login-prompt a:hover{background:#68e000;}
.cart-login-prompt a.outline{background:transparent;border:1px solid rgba(91,200,0,0.3);color:var(--green);margin-top:6px;}
.cart-login-prompt a.outline:hover{background:rgba(91,200,0,0.1);}
</style>

<script>
/* ══ CART ENGINE ══════════════════════════════════════════════════════════ */
const CART_KEY   = 'maxbat_cart_v1';
@php
    $isCustomer = auth()->check() && !auth()->user()->isAdmin();
@endphp
const CART_IS_AUTH    = {{ $isCustomer ? 'true' : 'false' }};
const ORDER_URL  = '{{ $isCustomer ? route("customer.orders.store") : "#" }}';
const CSRF_TOKEN = '{{ csrf_token() }}';

function cartLoad()   { try { return JSON.parse(localStorage.getItem(CART_KEY)) || []; } catch(e){ return []; } }
function cartSave(c)  { localStorage.setItem(CART_KEY, JSON.stringify(c)); cartUpdateBadge(); }
function cartClear()  { localStorage.removeItem(CART_KEY); cartUpdateBadge(); }

function cartUpdateBadge() {
    const cart  = cartLoad();
    const total = cart.reduce((s, i) => s + i.qty, 0);
    const badges = [document.getElementById('cartBadgeNav')];
    badges.forEach(b => {
        if (!b) return;
        if (total > 0) { b.textContent = total; b.style.display = 'flex'; }
        else           { b.style.display = 'none'; }
    });
    const countEl = document.getElementById('cartPaneCount');
    if (countEl) countEl.textContent = total > 0 ? total : '';
}

window.addToCart = function(id, name, price, image) {
    const cart = cartLoad();
    const idx  = cart.findIndex(i => i.id === id);
    // price may be a display string like "From UGX 45,000" — store as-is
    const priceVal = parseFloat(String(price).replace(/[^0-9.]/g, '')) || 0;
    if (idx > -1) { cart[idx].qty++; }
    else          { cart.push({ id, name, price: priceVal, priceDisplay: price || '—', image: image || '', qty: 1 }); }
    cartSave(cart);
    cartRenderPane();
    openCartPane();
    showCartToast(name + ' added to cart');
};

function showCartToast(msg) {
    let t = document.getElementById('cartToast');
    if (!t) {
        t = document.createElement('div');
        t.id = 'cartToast';
        t.style.cssText = 'position:fixed;bottom:90px;left:50%;transform:translateX(-50%) translateY(20px);background:#1C1C1C;border:1px solid rgba(91,200,0,0.25);border-left:3px solid var(--green);color:#fff;padding:12px 20px;border-radius:8px;font-family:Barlow,sans-serif;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px;box-shadow:0 8px 32px rgba(0,0,0,0.4);z-index:9999;opacity:0;pointer-events:none;transition:opacity 0.3s,transform 0.3s;';
        document.body.appendChild(t);
    }
    t.innerHTML = '<i class="fa fa-check-circle" style="color:var(--green);"></i> ' + msg;
    t.style.opacity = '1'; t.style.transform = 'translateX(-50%) translateY(0)';
    clearTimeout(t._timer);
    t._timer = setTimeout(() => { t.style.opacity='0'; t.style.transform='translateX(-50%) translateY(20px)'; }, 2500);
}

window.openCartPane = function() {
    document.getElementById('cartPane').classList.add('open');
    document.getElementById('cartPaneOverlay').classList.add('open');
    cartRenderPane();
};
window.closeCartPane = function() {
    document.getElementById('cartPane').classList.remove('open');
    document.getElementById('cartPaneOverlay').classList.remove('open');
};
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeCartPane(); });

function cartRenderPane() {
    const cart = cartLoad();
    const body = document.getElementById('cartPaneBody');
    if (!body) return;

    cartUpdateBadge();

    if (cart.length === 0) {
        body.innerHTML = `
            <div class="cart-empty">
                <i class="fa fa-shopping-cart"></i>
                <p>Your cart is empty.<br>Browse our products and add something!</p>
                <a href="{{ route('products') }}" onclick="closeCartPane()" style="margin-top:14px;display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:var(--green);color:#000;border-radius:7px;font-family:Barlow,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;text-decoration:none;">
                    <i class="fa fa-shopping-bag"></i> Shop Now
                </a>
            </div>`;
        return;
    }

    const total = cart.reduce((s, i) => s + (i.price || 0) * i.qty, 0);
    const totalDisplay = total > 0 ? '$' + total.toFixed(2) : 'Contact for pricing';
    const itemsHtml = cart.map((item, idx) => {
        const display  = item.priceDisplay || (item.price ? '$' + item.price.toFixed(2) : '—');
        const subtotal = item.price ? '$' + (item.price * item.qty).toFixed(2) : '—';
        return `
        <div class="cart-item">
            ${item.image
                ? `<img src="${item.image}" class="cart-item-img" alt="${escHtml(item.name)}">`
                : `<div class="cart-item-img"><i class="fa fa-box"></i></div>`
            }
            <div class="cart-item-info">
                <div class="cart-item-name">${escHtml(item.name)}</div>
                <div class="cart-item-price">${escHtml(display)}</div>
                <div class="cart-item-qty">
                    <button class="qty-btn" onclick="cartQty(${idx},-1)"><i class="fa fa-minus" style="font-size:10px;"></i></button>
                    <span class="qty-val">${item.qty}</span>
                    <button class="qty-btn" onclick="cartQty(${idx},1)"><i class="fa fa-plus" style="font-size:10px;"></i></button>
                </div>
            </div>
            <div style="text-align:right;flex-shrink:0;">
                <div style="font-family:'Bebas Neue',sans-serif;font-size:15px;color:rgba(255,255,255,0.5);">${subtotal}</div>
                <button class="cart-item-remove" onclick="cartRemove(${idx})" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>`;
    }).join('');

    // Checkout section — show login prompt if not auth
    const checkoutHtml = CART_IS_AUTH ? `
        <div class="cart-footer">
            <textarea class="cart-notes" id="cartNotes" rows="2" placeholder="Order notes (optional)…"></textarea>
            <div class="cart-total-row">
                <span class="cart-total-label">Total</span>
                <span class="cart-total-val">${totalDisplay}</span>
            </div>
            <button class="cart-checkout-btn" id="cartCheckoutBtn" onclick="cartCheckout()">
                <i class="fa fa-check-circle"></i> Place Order
            </button>
            <button class="cart-clear-btn" onclick="cartClearAll()">Clear Cart</button>
        </div>` : `
        <div class="cart-login-prompt">
            <i class="fa fa-lock"></i>
            <h3>Sign In to Checkout</h3>
            <p>You've added <strong style="color:#fff;">${cart.length} item${cart.length>1?'s':''}</strong> to your cart.<br>Sign in to complete your order — your cart is saved.</p>
            <button onclick="openAuthModal('login')" style="display:inline-flex;align-items:center;gap:8px;padding:11px 22px;background:var(--green);color:#000;border:none;border-radius:7px;font-family:Barlow,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;cursor:pointer;"><i class="fa fa-sign-in-alt"></i> Sign In</button>
            <button onclick="openAuthModal('register')" style="display:inline-flex;align-items:center;gap:8px;padding:11px 22px;background:transparent;border:1px solid rgba(91,200,0,0.3);color:var(--green);border-radius:7px;font-family:Barlow,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;cursor:pointer;margin-top:6px;"><i class="fa fa-user-plus"></i> Create Account</button>
        </div>`;

    body.innerHTML = `<div class="cart-items">${itemsHtml}</div>${checkoutHtml}`;
}

window.cartQty = function(idx, delta) {
    const cart = cartLoad();
    if (!cart[idx]) return;
    cart[idx].qty = Math.max(1, cart[idx].qty + delta);
    cartSave(cart); cartRenderPane();
};
window.cartRemove = function(idx) {
    const cart = cartLoad();
    cart.splice(idx, 1);
    cartSave(cart); cartRenderPane();
};
window.cartClearAll = function() {
    if (confirm('Clear your entire cart?')) { cartClear(); cartRenderPane(); }
};

window.cartCheckout = async function() {
    const cart = cartLoad();
    if (!cart.length) return;
    const btn   = document.getElementById('cartCheckoutBtn');
    const notes = document.getElementById('cartNotes')?.value || '';
    const total = cart.reduce((s, i) => s + (i.price || 0) * i.qty, 0);

    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Placing Order…';

    try {
        const res  = await fetch(ORDER_URL, {
            method:  'POST',
            headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN, 'X-Requested-With':'XMLHttpRequest' },
            body:    JSON.stringify({ items: cart, total: total.toFixed(2), notes })
        });
        const data = await res.json();
        if (data.success) {
            cartClear();
            document.getElementById('cartPaneBody').innerHTML = `
                <div style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:32px;gap:14px;">
                    <i class="fa fa-check-circle" style="font-size:56px;color:var(--green);"></i>
                    <h3 style="font-family:'Bebas Neue',sans-serif;font-size:24px;color:#fff;text-transform:uppercase;letter-spacing:1px;">Order Placed!</h3>
                    <p style="font-size:13px;color:rgba(255,255,255,0.55);line-height:1.7;">${data.message}</p>
                    <button onclick="closeCartPane()" style="padding:11px 24px;background:var(--green);color:#000;border:none;border-radius:7px;font-family:Barlow,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;cursor:pointer;">Done</button>
                </div>`;
        } else {
            alert(data.message || 'Could not place order. Please try again.');
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-check-circle"></i> Place Order';
        }
    } catch(e) {
        alert('Network error. Please try again.');
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-check-circle"></i> Place Order';
    }
};

function escHtml(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// Init badge on page load
document.addEventListener('DOMContentLoaded', cartUpdateBadge);
</script>
<style>
.coming-soon-toast {
    position: fixed; bottom: 90px; left: 50%; transform: translateX(-50%) translateY(20px);
    background: #1C1C1C; border: 1px solid var(--green-border); border-left: 3px solid var(--green);
    color: #fff; padding: 14px 24px; border-radius: 8px; font-family: 'Barlow', sans-serif;
    font-size: 14px; font-weight: 600; letter-spacing: 0.5px;
    display: flex; align-items: center; gap: 10px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.4); z-index: 9999;
    opacity: 0; pointer-events: none;
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.coming-soon-toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
.coming-soon-toast i { color: var(--green); font-size: 16px; }
@media(min-width:1024px){ .coming-soon-toast { bottom: 40px; } }
</style>

<div class="coming-soon-toast" id="comingSoonToast" role="status" aria-live="polite">
    <i class="fa fa-clock"></i> Service coming soon — stay tuned!
</div>

<script>
function showComingSoon(e) {
    e.preventDefault();
    const toast = document.getElementById('comingSoonToast');
    toast.classList.add('show');
    clearTimeout(toast._timer);
    toast._timer = setTimeout(() => toast.classList.remove('show'), 3000);
}
</script>
@stack('scripts')

{{-- ── AUTH MODAL ─────────────────────────────────────────────────────── --}}
<style>
.auth-overlay{position:fixed;inset:0;z-index:1300;background:rgba(0,0,0,0.75);backdrop-filter:blur(6px);display:none;align-items:center;justify-content:center;padding:20px;}
.auth-overlay.open{display:flex;}
.auth-modal{background:#161616;border:1px solid rgba(255,255,255,0.08);border-radius:16px;width:100%;max-width:420px;border-top:3px solid var(--green);overflow:hidden;position:relative;}
.auth-modal-body{padding:36px;}
.auth-logo{text-align:center;margin-bottom:24px;}
.auth-logo img{height:52px;border-radius:7px;margin:0 auto;}
.auth-title{font-family:'Bebas Neue',sans-serif;font-size:28px;text-transform:uppercase;letter-spacing:1px;color:#fff;margin-bottom:4px;}
.auth-sub{font-size:14px;color:rgba(255,255,255,0.4);margin-bottom:24px;}
.auth-group{margin-bottom:16px;}
.auth-label{display:block;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,0.5);margin-bottom:6px;}
.auth-input{width:100%;background:#1e1e1e;border:1px solid rgba(255,255,255,0.10);color:#fff;padding:12px 14px;border-radius:7px;font-size:14px;font-family:'Barlow',sans-serif;transition:border-color 0.2s;}
.auth-input:focus{outline:none;border-color:var(--green);box-shadow:0 0 0 3px rgba(91,200,0,0.1);}
.auth-input::placeholder{color:rgba(255,255,255,0.2);}
.auth-input.err{border-color:rgba(225,6,0,0.5);}
.auth-field-err{font-size:12px;color:#ff6b6b;margin-top:4px;}
.auth-btn{width:100%;padding:13px;background:var(--green);color:#000;border:none;border-radius:7px;font-family:'Barlow',sans-serif;font-size:15px;font-weight:700;text-transform:uppercase;letter-spacing:1px;cursor:pointer;transition:background 0.2s;display:flex;align-items:center;justify-content:center;gap:8px;margin-top:8px;}
.auth-btn:hover{background:#68e000;}
.auth-btn:disabled{background:#333;color:#666;cursor:not-allowed;}
.auth-switch{text-align:center;margin-top:20px;font-size:14px;color:rgba(255,255,255,0.4);}
.auth-switch button{background:none;border:none;color:var(--green);font-weight:700;font-size:14px;cursor:pointer;padding:0;font-family:'Barlow',sans-serif;}
.auth-switch button:hover{text-decoration:underline;}
.auth-close{position:absolute;top:14px;right:14px;width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,0.06);border:none;color:#fff;font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.2s;z-index:1;}
.auth-close:hover{background:rgba(225,6,0,0.2);color:#ff6b6b;}
.auth-alert{padding:10px 14px;border-radius:7px;font-size:13px;margin-bottom:16px;display:none;}
.auth-alert.err{background:rgba(225,6,0,0.10);border:1px solid rgba(225,6,0,0.2);color:#ff6b6b;display:block;}
.auth-alert.ok{background:rgba(91,200,0,0.10);border:1px solid rgba(91,200,0,0.2);color:var(--green);display:block;}
.auth-divider{text-align:center;margin:16px 0;font-size:12px;color:rgba(255,255,255,0.2);letter-spacing:1px;text-transform:uppercase;}
</style>

<div class="auth-overlay" id="authOverlay" role="dialog" aria-modal="true" aria-label="Sign in or register">
    <div class="auth-modal" id="authModal">
        <button class="auth-close" onclick="closeAuthModal()" aria-label="Close">✕</button>
        <div class="auth-modal-body">
            <div class="auth-logo">
                <img src="{{ asset('storage/maxbat.jpg') }}" alt="MaxBat">
            </div>

            {{-- ALERT --}}
            <div class="auth-alert" id="authAlert"></div>

            {{-- LOGIN FORM --}}
            <div id="authLoginForm">
                <div class="auth-title">Welcome Back</div>
                <div class="auth-sub">Sign in to your MaxBat account</div>
                <form id="loginForm" novalidate>
                    @csrf
                    <div class="auth-group">
                        <label class="auth-label">Email Address</label>
                        <input type="email" name="email" class="auth-input" placeholder="you@example.com" required autocomplete="email">
                    </div>
                    <div class="auth-group">
                        <label class="auth-label">Password</label>
                        <input type="password" name="password" class="auth-input" placeholder="••••••••" required autocomplete="current-password">
                    </div>
                    <button type="submit" class="auth-btn" id="loginBtn">
                        <i class="fa fa-sign-in-alt"></i> <span>Sign In</span>
                    </button>
                </form>
                <div class="auth-switch">
                    Don't have an account? <button onclick="openAuthModal('register')">Create one</button>
                </div>
                <div class="auth-divider">or</div>
                <div style="text-align:center;font-size:13px;color:rgba(255,255,255,0.3);">
                    Admin? <a href="{{ route('admin.login') }}" style="color:rgba(255,255,255,0.5);">Admin login →</a>
                </div>
            </div>

            {{-- REGISTER FORM --}}
            <div id="authRegisterForm" style="display:none;">
                <div class="auth-title">Create Account</div>
                <div class="auth-sub">Join MaxBat — it's free</div>
                <form id="registerForm" novalidate>
                    @csrf
                    <div class="auth-group">
                        <label class="auth-label">Full Name</label>
                        <input type="text" name="name" class="auth-input" placeholder="Your full name" required autocomplete="name">
                    </div>
                    <div class="auth-group">
                        <label class="auth-label">Email Address</label>
                        <input type="email" name="email" class="auth-input" placeholder="you@example.com" required autocomplete="email">
                    </div>
                    <div class="auth-group">
                        <label class="auth-label">Password</label>
                        <input type="password" name="password" class="auth-input" placeholder="At least 8 characters" required autocomplete="new-password">
                    </div>
                    <div class="auth-group">
                        <label class="auth-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="auth-input" placeholder="Repeat password" required autocomplete="new-password">
                    </div>
                    <button type="submit" class="auth-btn" id="registerBtn">
                        <i class="fa fa-user-plus"></i> <span>Create Account</span>
                    </button>
                </form>
                <div class="auth-switch">
                    Already have an account? <button onclick="openAuthModal('login')">Sign In</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    const overlay  = document.getElementById('authOverlay');
    const loginF   = document.getElementById('authLoginForm');
    const registerF= document.getElementById('authRegisterForm');
    const alertEl  = document.getElementById('authAlert');

    window.openAuthModal = function(tab) {
        alertEl.className = 'auth-alert';
        alertEl.textContent = '';
        loginF.style.display    = tab === 'login'    ? '' : 'none';
        registerF.style.display = tab === 'register' ? '' : 'none';
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            const first = overlay.querySelector('input');
            if (first) first.focus();
        }, 100);
    };

    window.closeAuthModal = function() {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    };

    overlay.addEventListener('click', e => { if (e.target === overlay) closeAuthModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeAuthModal(); });

    function setAlert(msg, type) {
        alertEl.textContent = msg;
        alertEl.className = 'auth-alert ' + type;
    }
    function clearAlert() { alertEl.className = 'auth-alert'; }

    function setBtnLoading(btn, loading) {
        const span = btn.querySelector('span');
        btn.disabled = loading;
        if (loading) { span.textContent = 'Please wait…'; }
    }

    // LOGIN
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        clearAlert();
        const btn = document.getElementById('loginBtn');
        setBtnLoading(btn, true);
        const fd = new FormData(this);
        try {
            const res  = await fetch('{{ route("login.post") }}', {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: fd
            });
            const data = await res.json();
            if (data.success) {
                setAlert('Signed in! Redirecting…', 'ok');
                setTimeout(() => {
                    if (data.redirect) { window.location.href = data.redirect; }
                    else { window.location.reload(); }
                }, 800);
            } else {
                setAlert(data.message || 'Invalid email or password.', 'err');
                setBtnLoading(btn, false);
            }
        } catch(err) {
            setAlert('Network error. Please try again.', 'err');
            setBtnLoading(btn, false);
        }
    });

    // REGISTER
    document.getElementById('registerForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        clearAlert();
        const btn = document.getElementById('registerBtn');
        setBtnLoading(btn, true);
        const fd = new FormData(this);
        try {
            const res  = await fetch('{{ route("register.post") }}', {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: fd
            });
            const data = await res.json();
            if (data.success) {
                setAlert('Account created! Redirecting…', 'ok');
                setTimeout(() => {
                    if (data.redirect) { window.location.href = data.redirect; }
                    else { window.location.reload(); }
                }, 800);
            } else {
                const msg = data.errors
                    ? Object.values(data.errors).flat().join(' ')
                    : (data.message || 'Registration failed.');
                setAlert(msg, 'err');
                setBtnLoading(btn, false);
            }
        } catch(err) {
            setAlert('Network error. Please try again.', 'err');
            setBtnLoading(btn, false);
        }
    });
})();
</script>
</body>
</html>
