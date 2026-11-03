<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ config('app.name', 'Gabe Medica') }} — Solusi Kesehatan Modern & Terpercaya</title>
    <link rel="icon" type="image/png" href="{{ asset('images/gabe-medica-icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased selection:bg-[#012D68] selection:text-white">
    <!-- SVG Sprite Definitions -->
    <svg width="0" height="0" class="hidden" style="position: absolute; width: 0; height: 0; overflow: hidden;" aria-hidden="true">
        <defs>
            <symbol id="icon-plus" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="4"/><path d="M12 8v8M8 12h8"/></symbol>
            <symbol id="icon-home" viewBox="0 0 24 24"><path d="M3 11 12 3l9 8v9a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/></symbol>
            <symbol id="icon-cal" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="3"/><path d="M8 3v4M16 3v4M3 10h18"/></symbol>
            <symbol id="icon-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></symbol>
            <symbol id="icon-doc" viewBox="0 0 24 24"><path d="M6 3h8l5 5v13H6z"/><path d="M14 3v5h5M9 13h6M9 17h6"/></symbol>
            <symbol id="icon-set" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M4.9 4.9l2.1 2.1M17 17l2.1 2.1M4.9 19.1 7 17M17 7l2.1-2.1"/></symbol>
            <symbol id="icon-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></symbol>
            <symbol id="icon-bell" viewBox="0 0 24 24"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 8 3 8H3s3-1 3-8M10 20a2 2 0 0 0 4 0"/></symbol>
            <symbol id="icon-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
            <symbol id="icon-vid" viewBox="0 0 24 24"><rect x="2" y="6" width="14" height="12" rx="3"/><path d="m16 10 6-3v10l-6-3"/></symbol>
            <symbol id="icon-up" viewBox="0 0 24 24"><path d="M7 17 17 7M8 7h9v9"/></symbol>
            <symbol id="icon-left" viewBox="0 0 24 24"><path d="M19 12H5M11 6l-6 6 6 6"/></symbol>
            <symbol id="icon-msg" viewBox="0 0 24 24"><path d="M21 12a8 8 0 0 1-11.6 7.1L4 20l1-4.6A8 8 0 1 1 21 12z"/></symbol>
            <symbol id="icon-phone" viewBox="0 0 24 24"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/></symbol>
            <symbol id="icon-close" viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12"/></symbol>
            <symbol id="icon-sparkle" viewBox="0 0 24 24"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3z"/></symbol>
            <symbol id="icon-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></symbol>
            <symbol id="icon-moon" viewBox="0 0 24 24"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></symbol>
        </defs>
    </svg>

    <!-- Global Toast Notification -->
    <div id="app-toast" class="app-toast" role="status" aria-live="polite"></div>

    <div class="min-h-screen flex flex-col bg-[var(--color-bg-app)]">
        @yield('content')
    </div>
</body>
</html>
