<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Inventaris Aset &mdash; PT. Sentra Gemilang Mulia</title>
    <meta name="description" content="Sistem manajemen inventaris aset SGM Group" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold:        #F5A800;
            --gold-deep:   #D48900;
            --gold-light:  #FFF0C2;
            --ember:       #D94F00;
            --ember-light: #FF6E20;
            --cream:       #FFFBF3;
            --straw:       #8B5E3C;
            --mahogany:    #3D1C02;
            --ink:         #1A0A00;
            --white:       #FFFFFF;
            --ray-color:   rgba(213,141,0,0.18);
        }

        html, body {
            height: 100%;
            background-color: var(--cream);
            font-family: 'Inter', sans-serif;
            color: var(--ink);
            overflow-x: hidden;
        }

        /* ─── SUN RAY BACKGROUND ─── */
        .sun-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .sun-canvas svg {
            position: absolute;
            top: -60%;
            left: 50%;
            transform: translateX(-50%);
            width: 180vw;
            max-width: 1400px;
            opacity: 0;
            animation: fadeRays 1.6s ease forwards 0.3s;
        }

        @keyframes fadeRays {
            from { opacity: 0; transform: translateX(-50%) rotate(-8deg) scale(0.9); }
            to   { opacity: 1; transform: translateX(-50%) rotate(0deg)  scale(1);   }
        }

        /* ─── LAYOUT ─── */
        .page {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 2rem 1.5rem 1.5rem;
        }

        /* ─── HEADER / BRAND ─── */
        .brand {
            text-align: center;
            opacity: 0;
            transform: translateY(-20px);
            animation: slideDown 0.8s cubic-bezier(.22,.68,0,1.2) forwards 0.6s;
        }

        @keyframes slideDown {
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-logo-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: var(--white);
            box-shadow: 0 0 0 4px var(--gold), 0 8px 32px rgba(213,137,0,0.22);
            margin-bottom: 1rem;
        }

        .brand-logo-wrap img {
            width: 62px;
            height: 62px;
            object-fit: contain;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.35rem, 4vw, 1.75rem);
            font-weight: 700;
            color: var(--mahogany);
            letter-spacing: -0.01em;
            line-height: 1.2;
        }

        .brand-sub {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--straw);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-top: 0.35rem;
        }

        .brand-divider {
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--ember));
            border-radius: 99px;
            margin: 1rem auto 0;
        }

        /* ─── SYSTEM LABEL ─── */
        .system-label {
            margin-top: 0.9rem;
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--white);
            background: var(--ember);
            letter-spacing: 0.16em;
            text-transform: uppercase;
            padding: 0.3rem 0.85rem;
            border-radius: 99px;
            display: inline-block;
        }

        /* ─── MAIN CTA ─── */
        .cta-section {
            width: 100%;
            max-width: 780px;
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 0.9s cubic-bezier(.22,.68,0,1.2) forwards 1.0s;
        }

        @keyframes slideUp {
            to { opacity: 1; transform: translateY(0); }
        }

        .cta-heading {
            text-align: center;
            font-size: clamp(0.8rem, 2.5vw, 0.9rem);
            color: var(--straw);
            font-weight: 500;
            letter-spacing: 0.05em;
            margin-bottom: 1.5rem;
        }

        .cta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* ─── CARD ─── */
        .cta-card {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 0.85rem;
            padding: 2.2rem 1.5rem 2rem;
            border-radius: 20px;
            background: var(--white);
            border: 1.5px solid rgba(245,168,0,0.25);
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
            -webkit-tap-highlight-color: transparent;
        }

        .cta-card::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: inherit;
        }

        .cta-card--scan::before  { background: linear-gradient(145deg, rgba(245,168,0,0.06), rgba(217,79,0,0.04)); }
        .cta-card--login::before { background: linear-gradient(145deg, rgba(61,28,2,0.04), rgba(139,94,60,0.05)); }

        .cta-card:hover {
            transform: translateY(-5px);
            border-color: var(--gold);
        }

        .cta-card:hover::before { opacity: 1; }

        .cta-card--scan:hover  { box-shadow: 0 16px 48px rgba(245,168,0,0.22); }
        .cta-card--login:hover { box-shadow: 0 16px 48px rgba(61,28,2,0.14); }

        .cta-card:active { transform: translateY(-2px) scale(0.98); }

        /* Icon bubble */
        .cta-icon {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform 0.3s cubic-bezier(.22,.68,0,1.4);
        }

        .cta-card:hover .cta-icon { transform: scale(1.08) rotate(-3deg); }

        .cta-icon--scan  { background: linear-gradient(135deg, var(--gold), var(--ember)); }
        .cta-icon--login { background: linear-gradient(135deg, var(--mahogany), var(--straw)); }

        .cta-icon svg { width: 32px; height: 32px; }

        /* Card text */
        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.05rem, 3vw, 1.25rem);
            font-weight: 700;
            color: var(--mahogany);
            line-height: 1.2;
        }

        .cta-desc {
            font-size: 0.8rem;
            color: var(--straw);
            font-weight: 400;
            line-height: 1.5;
            max-width: 18ch;
            margin: 0 auto;
        }

        /* Pill badge */
        .cta-badge {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.22rem 0.7rem;
            border-radius: 99px;
            margin-top: 0.15rem;
        }

        .cta-badge--scan  { background: var(--gold-light); color: var(--gold-deep); }
        .cta-badge--login { background: rgba(61,28,2,0.07); color: var(--mahogany); }

        /* Arrow hint */
        .cta-arrow {
            position: absolute;
            bottom: 1rem;
            right: 1.1rem;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: translateX(-4px);
            transition: opacity 0.25s ease, transform 0.25s ease;
        }

        .cta-card:hover .cta-arrow {
            opacity: 1;
            transform: translateX(0);
        }

        .cta-arrow svg { width: 14px; height: 14px; stroke: var(--straw); }

        /* ─── FOOTER ─── */
        .footer {
            text-align: center;
            opacity: 0;
            animation: fadeIn 0.8s ease forwards 1.6s;
        }

        @keyframes fadeIn { to { opacity: 1; } }

        .footer-copy {
            font-size: 0.7rem;
            color: var(--straw);
            opacity: 0.7;
            line-height: 1.7;
        }

        .footer-copy strong {
            font-weight: 600;
            color: var(--mahogany);
            opacity: 1;
        }

        .footer-dot {
            display: inline-block;
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: var(--gold);
            margin: 0 0.4rem;
            vertical-align: middle;
        }

        /* ─── PULSE RING on scan icon ─── */
        .pulse-ring {
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px solid var(--gold);
            opacity: 0;
            animation: pulse 2.8s ease-in-out infinite 1.8s;
        }

        @keyframes pulse {
            0%   { transform: scale(0.88); opacity: 0.6; }
            70%  { transform: scale(1.25); opacity: 0; }
            100% { transform: scale(1.25); opacity: 0; }
        }

        .cta-icon-wrap { position: relative; display: inline-flex; }

        /* ─── MOBILE ─── */
        @media (max-width: 500px) {
            .page { padding: 1.5rem 1rem 1.2rem; gap: 1.2rem; }

            .brand-logo-wrap { width: 72px; height: 72px; }
            .brand-logo-wrap img { width: 50px; height: 50px; }
            .brand-name { font-size: 1.2rem; }

            .cta-grid { gap: 0.75rem; }

            .cta-card { padding: 1.6rem 1rem 1.5rem; border-radius: 16px; gap: 0.65rem; }
            .cta-icon  { width: 56px; height: 56px; }
            .cta-icon svg { width: 26px; height: 26px; }
            .cta-title { font-size: 1rem; }
            .cta-desc  { font-size: 0.73rem; max-width: 20ch; }
        }

        @media (max-width: 380px) {
            .cta-grid { grid-template-columns: 1fr; max-width: 320px; margin: 0 auto; }
        }

        /* ─── REDUCED MOTION ─── */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>

<!-- ── SUN RAY BACKDROP ── -->
<div class="sun-canvas" aria-hidden="true">
    <svg viewBox="0 0 1200 700" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(600,0)">
            <!-- 18 rays emanating from top-center -->
            <line x1="0" y1="0" x2="-580" y2="700" stroke="#F5A800" stroke-width="60" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="-440" y2="700" stroke="#D94F00" stroke-width="44" stroke-opacity="0.06"/>
            <line x1="0" y1="0" x2="-300" y2="700" stroke="#F5A800" stroke-width="50" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="-160" y2="700" stroke="#D94F00" stroke-width="36" stroke-opacity="0.05"/>
            <line x1="0" y1="0" x2="-50"  y2="700" stroke="#F5A800" stroke-width="54" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="0"    y2="700" stroke="#F5A800" stroke-width="42" stroke-opacity="0.06"/>
            <line x1="0" y1="0" x2="50"   y2="700" stroke="#D94F00" stroke-width="56" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="160"  y2="700" stroke="#F5A800" stroke-width="38" stroke-opacity="0.05"/>
            <line x1="0" y1="0" x2="300"  y2="700" stroke="#D94F00" stroke-width="52" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="440"  y2="700" stroke="#F5A800" stroke-width="40" stroke-opacity="0.06"/>
            <line x1="0" y1="0" x2="580"  y2="700" stroke="#D94F00" stroke-width="58" stroke-opacity="0.07"/>
        </g>
    </svg>
</div>

<!-- ── PAGE ── -->
<div class="page">

    <!-- BRAND HEADER -->
    <header class="brand">
        <div class="brand-logo-wrap">
            <img src="{{ asset('storage/company-logos/logo-sgm.png') }}" alt="Logo PT. Sentra Gemilang Mulia" />
        </div>
        <div class="brand-name">PT. Sentra Gemilang Mulia</div>
        <div class="brand-sub">SGM Group</div>
        <div class="brand-divider"></div>
        <span class="system-label">Sistem Inventaris Aset</span>
    </header>

    <!-- CTA SECTION -->
    <main class="cta-section">
        <p class="cta-heading">Silakan pilih aksi yang ingin Anda lakukan</p>

        <div class="cta-grid" role="list">

            <!-- SCAN QR -->
            <a href="{{ route('items.scan-camera') }}" class="cta-card cta-card--scan" role="listitem" aria-label="Scan QR Code aset">
                <div class="cta-icon-wrap">
                    <div class="cta-icon cta-icon--scan">
                        <!-- QR scan icon -->
                        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <rect x="4"  y="4"  width="10" height="10" rx="2" stroke="#fff" stroke-width="2"/>
                            <rect x="18" y="4"  width="10" height="10" rx="2" stroke="#fff" stroke-width="2"/>
                            <rect x="4"  y="18" width="10" height="10" rx="2" stroke="#fff" stroke-width="2"/>
                            <rect x="7"  y="7"  width="4"  height="4"  rx="0.5" fill="#fff"/>
                            <rect x="21" y="7"  width="4"  height="4"  rx="0.5" fill="#fff"/>
                            <rect x="7"  y="21" width="4"  height="4"  rx="0.5" fill="#fff"/>
                            <line x1="18" y1="18" x2="18" y2="22" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                            <line x1="18" y1="26" x2="18" y2="28" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                            <line x1="22" y1="18" x2="28" y2="18" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                            <line x1="22" y1="22" x2="22" y2="28" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                            <line x1="26" y1="22" x2="28" y2="22" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                            <line x1="26" y1="26" x2="28" y2="26" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="pulse-ring" aria-hidden="true"></span>
                </div>
                <div>
                    <div class="cta-title">Scan QR Code</div>
                    <div class="cta-desc">Pindai kode aset secara langsung</div>
                </div>
                <span class="cta-badge cta-badge--scan">Tanpa Login</span>
                <span class="cta-arrow" aria-hidden="true">
                    <svg viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
            </a>

            <!-- LOGIN -->
            <a href="{{ route('filament.admin.auth.login') }}" class="cta-card cta-card--login" role="listitem" aria-label="Login ke Sistem Inventaris">
                <div class="cta-icon-wrap">
                    <div class="cta-icon cta-icon--login">
                        <!-- Shield / key icon -->
                        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M16 3L5 8v8c0 6.627 4.925 11.734 11 12 6.075-.266 11-5.373 11-12V8L16 3z" stroke="#fff" stroke-width="2" stroke-linejoin="round"/>
                            <circle cx="16" cy="15" r="3.5" stroke="#fff" stroke-width="2"/>
                            <line x1="16" y1="18.5" x2="16" y2="22" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <div class="cta-title">Login Sistem</div>
                    <div class="cta-desc">Masuk ke dasbor manajemen aset</div>
                </div>
                <span class="cta-badge cta-badge--login">Administrator</span>
                <span class="cta-arrow" aria-hidden="true">
                    <svg viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
            </a>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <p class="footer-copy">
            &copy; {{ date('Y') }} <strong>PT. Sentra Gemilang Mulia</strong>
            <span class="footer-dot"></span>
            Dikembangkan oleh <strong>Tim IT SGM Group</strong>
        </p>
        {{-- <p class="footer-copy" style="margin-top:0.2rem; font-size:0.63rem;">
            Sistem Inventaris Aset &bull; Powered by Laravel &amp; Filament
        </p> --}}
    </footer>

</div>

</body>
</html>