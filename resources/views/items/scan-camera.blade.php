<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scan QR Aset &mdash; SGM Group</title>
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
            --cream:       #FFFBF3;
            --straw:       #8B5E3C;
            --mahogany:    #3D1C02;
            --ink:         #1A0A00;
            --white:       #FFFFFF;
            --border:      rgba(245,168,0,0.22);
            --border-soft: rgba(61,28,2,0.08);
            --success:     #059669;
            --success-bg:  #d1fae5;
            --danger:      #DC2626;
            --danger-bg:   #fee2e2;
        }

        html { height: 100%; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--ink);
            background: var(--cream);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-bottom: 80px;
            overflow-x: hidden;
        }

        /* ─── ANIMATED SUN RAY BG ─── */
        .sun-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .sun-bg svg {
            position: absolute;
            top: -60%;
            left: 50%;
            transform: translateX(-50%);
            width: 180vw;
            max-width: 1400px;
            opacity: 0.45;
        }

        /* ─── HEADER ─── */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--white);
            border-bottom: 1px solid var(--border);
        }
        .header-ray {
            height: 3px;
            background: linear-gradient(90deg, var(--gold) 0%, var(--ember) 50%, var(--gold) 100%);
            background-size: 200% 100%;
            animation: shiftRay 4s linear infinite;
        }
        @keyframes shiftRay {
            0%   { background-position: 0%   50%; }
            100% { background-position: 200% 50%; }
        }
        .header-inner {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem;
            max-width: 680px;
            margin: 0 auto;
        }
        .header-logo-ring {
            width: 38px; height: 38px;
            border-radius: 50%;
            border: 2px solid var(--gold);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; overflow: hidden;
            background: var(--white);
        }
        .header-logo-ring img { width: 26px; height: 26px; object-fit: contain; }
        .header-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 0.92rem; font-weight: 700; color: var(--mahogany); line-height: 1.1;
        }
        .header-brand-sub {
            font-size: 0.6rem; font-weight: 500; color: var(--straw);
            letter-spacing: 0.1em; text-transform: uppercase;
        }

        /* ─── PAGE WRAPPER ─── */
        .page {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.25rem 1rem;
            gap: 1.5rem;
            animation: fadeIn 0.5s ease both;
        }
        @keyframes fadeIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }

        /* ─── PAGE TITLE ─── */
        .page-eyebrow {
            font-size: 0.65rem; font-weight: 600; color: var(--straw);
            letter-spacing: 0.16em; text-transform: uppercase; text-align: center;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.3rem, 4vw, 1.65rem);
            font-weight: 700; color: var(--mahogany); text-align: center;
            margin-top: 0.25rem; line-height: 1.2;
        }
        .page-desc {
            font-size: 0.8rem; color: var(--straw); text-align: center; line-height: 1.6;
            max-width: 28ch; margin: 0 auto; margin-top: 0.4rem;
        }

        /* ─── SCANNER CARD ─── */
        .scanner-card {
            width: 100%;
            max-width: 420px;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(245,168,0,0.12);
        }

        /* QR reader area */
        .reader-wrap {
            position: relative;
            background: #0d0a05;
            overflow: hidden;
        }

        #reader {
            width: 100% !important;
        }

        /* Hide html5-qrcode default UI chrome we don't need */
        #reader img { display: none !important; }
        #reader__scan_region { border: none !important; }
        #reader__dashboard { display: none !important; }

        /* ── Scan frame overlay ── */
        .scan-frame-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .scan-frame {
            position: relative;
            width: 200px;
            height: 200px;
        }

        /* Corner brackets */
        .scan-frame::before,
        .scan-frame::after,
        .scan-frame .corner-br,
        .scan-frame .corner-bl {
            content: '';
            position: absolute;
            width: 28px;
            height: 28px;
            border-color: var(--gold);
            border-style: solid;
        }
        .scan-frame::before  { top:0;    left:0;  border-width: 3px 0 0 3px; border-radius: 4px 0 0 0; }
        .scan-frame::after   { top:0;    right:0; border-width: 3px 3px 0 0; border-radius: 0 4px 0 0; }
        .scan-frame .corner-br { bottom:0; right:0; border-width: 0 3px 3px 0; border-radius: 0 0 4px 0; }
        .scan-frame .corner-bl { bottom:0; left:0;  border-width: 0 0 3px 3px; border-radius: 0 0 0 4px; }

        /* Scanning laser line */
        .scan-laser {
            position: absolute;
            left: 4px;
            right: 4px;
            top: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--ember), var(--gold), transparent);
            border-radius: 99px;
            animation: laserScan 2s ease-in-out infinite;
            box-shadow: 0 0 8px rgba(245,168,0,0.6);
        }
        @keyframes laserScan {
            0%   { top: 4px;   opacity: 1; }
            48%  { opacity: 1; }
            50%  { top: 192px; opacity: 0.8; }
            52%  { opacity: 1; }
            100% { top: 4px;   opacity: 1; }
        }

        /* Status row below reader */
        .scanner-status-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.85rem 1.25rem;
            border-top: 1px solid var(--border-soft);
            background: var(--white);
        }
        .scanner-live-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--success);
            animation: liveBlink 1.4s ease-in-out infinite;
        }
        @keyframes liveBlink { 0%,100%{opacity:1} 50%{opacity:0.3} }
        .scanner-live-text {
            font-size: 0.75rem; font-weight: 500; color: var(--straw);
        }

        /* ─── RESULT PANEL (replaces scanner card on result) ─── */
        .result-panel {
            display: none;
            width: 100%;
            max-width: 420px;
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            border: 1.5px solid var(--border);
            box-shadow: 0 8px 40px rgba(245,168,0,0.12);
            animation: popIn 0.4s cubic-bezier(.22,.68,0,1.3) both;
        }
        @keyframes popIn { from{opacity:0;transform:scale(0.88)} to{opacity:1;transform:scale(1)} }

        .result-panel.visible { display: block; }

        /* Result icon area */
        .result-icon-area {
            padding: 2rem 1.5rem 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .result-icon-ring {
            width: 80px; height: 80px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            position: relative;
        }
        .result-icon-ring svg { width: 40px; height: 40px; }

        .result-icon-ring--success {
            background: var(--success-bg);
            border: 2px solid rgba(5,150,105,0.2);
        }
        .result-icon-ring--success svg { color: var(--success); }

        .result-icon-ring--error {
            background: var(--danger-bg);
            border: 2px solid rgba(220,38,38,0.2);
        }
        .result-icon-ring--error svg { color: var(--danger); }

        /* Ripple on success */
        .result-ripple {
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px solid var(--success);
            opacity: 0;
            animation: rippleOut 1.2s ease-out infinite 0.2s;
        }
        @keyframes rippleOut {
            0%   { transform:scale(0.9); opacity:0.6; }
            100% { transform:scale(1.5); opacity:0; }
        }

        .result-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem; font-weight: 700;
            text-align: center; line-height: 1.2;
        }
        .result-title--success { color: var(--success); }
        .result-title--error   { color: var(--danger); }

        .result-desc {
            font-size: 0.8rem; color: var(--straw);
            text-align: center; line-height: 1.55;
            max-width: 26ch; margin: 0 auto;
        }

        /* Loading dots */
        .loading-dots {
            display: flex; gap: 5px; margin-top: 0.5rem;
        }
        .loading-dots span {
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--success); opacity: 0.3;
        }
        .loading-dots span:nth-child(1) { animation: dotPulse 1.2s ease-in-out infinite 0.0s; }
        .loading-dots span:nth-child(2) { animation: dotPulse 1.2s ease-in-out infinite 0.2s; }
        .loading-dots span:nth-child(3) { animation: dotPulse 1.2s ease-in-out infinite 0.4s; }
        @keyframes dotPulse { 0%,100%{opacity:0.3} 50%{opacity:1} }

        .result-actions {
            padding: 0 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .btn-result {
            width: 100%; height: 46px;
            border-radius: 12px; border: none; cursor: pointer;
            font-family: 'Inter', sans-serif; font-size: 0.85rem; font-weight: 600;
            display: flex; align-items: center; justify-content: center; gap: 0.45rem;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-result:active { transform: scale(0.97); }
        .btn-result svg { width: 18px; height: 18px; }

        .btn-result--primary {
            background: linear-gradient(135deg, var(--gold), var(--ember));
            color: var(--white);
        }
        .btn-result--secondary {
            background: var(--white);
            color: var(--mahogany);
            border: 1.5px solid var(--border);
        }
        .btn-result--secondary:hover { background: var(--gold-light); }

        /* ─── TIPS CARD (below scanner) ─── */
        .tips-card {
            width: 100%;
            max-width: 420px;
            display: flex;
            gap: 0.75rem;
            padding: 0.9rem 1.1rem;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 16px;
        }
        .tips-icon {
            width: 34px; height: 34px;
            border-radius: 9px;
            background: var(--gold-light);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .tips-icon svg { width: 17px; height: 17px; color: var(--gold-deep); }
        .tips-title { font-size: 0.75rem; font-weight: 600; color: var(--mahogany); margin-bottom: 0.15rem; }
        .tips-body  { font-size: 0.7rem; color: var(--straw); line-height: 1.55; }

        /* ─── STICKY BOTTOM BAR ─── */
        .bottom-bar {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            z-index: 100;
            background: var(--white);
            border-top: 1px solid var(--border);
            padding: 0.75rem 1.25rem;
            padding-bottom: max(0.75rem, env(safe-area-inset-bottom));
        }
        .bottom-bar-inner {
            display: flex; gap: 0.75rem;
            max-width: 680px; margin: 0 auto;
        }
        .btn-bottom {
            flex: 1; height: 46px; border-radius: 12px;
            font-family: 'Inter', sans-serif; font-size: 0.82rem; font-weight: 600;
            display: flex; align-items: center; justify-content: center; gap: 0.4rem;
            text-decoration: none; cursor: pointer; border: none;
            transition: transform 0.15s, opacity 0.2s;
        }
        .btn-bottom:active { transform: scale(0.97); }
        .btn-bottom--home  { background: linear-gradient(135deg,var(--gold),var(--ember)); color:var(--white); }
        .btn-bottom--admin { background: var(--mahogany); color: var(--white); }
        .btn-bottom svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 480px) {
            .page { padding: 1.25rem 1rem 1rem; gap: 1.1rem; }
            .scan-frame { width: 170px; height: 170px; }
            @keyframes laserScan {
                0%   { top:4px;   opacity:1; }
                50%  { top:162px; opacity:0.8; }
                100% { top:4px;   opacity:1; }
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration:0.01ms !important; transition-duration:0.01ms !important; }
        }
    </style>
</head>
<body>

<!-- Sun ray bg -->
<div class="sun-bg" aria-hidden="true">
    <svg viewBox="0 0 1200 700" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(600,0)">
            <line x1="0" y1="0" x2="-580" y2="700" stroke="#F5A800" stroke-width="70" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="-420" y2="700" stroke="#D94F00" stroke-width="50" stroke-opacity="0.05"/>
            <line x1="0" y1="0" x2="-270" y2="700" stroke="#F5A800" stroke-width="60" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="-130" y2="700" stroke="#D94F00" stroke-width="40" stroke-opacity="0.05"/>
            <line x1="0" y1="0" x2="-40"  y2="700" stroke="#F5A800" stroke-width="65" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="0"    y2="700" stroke="#F5A800" stroke-width="48" stroke-opacity="0.06"/>
            <line x1="0" y1="0" x2="40"   y2="700" stroke="#D94F00" stroke-width="68" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="130"  y2="700" stroke="#F5A800" stroke-width="44" stroke-opacity="0.05"/>
            <line x1="0" y1="0" x2="270"  y2="700" stroke="#D94F00" stroke-width="62" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="420"  y2="700" stroke="#F5A800" stroke-width="46" stroke-opacity="0.06"/>
            <line x1="0" y1="0" x2="580"  y2="700" stroke="#D94F00" stroke-width="70" stroke-opacity="0.07"/>
        </g>
    </svg>
</div>

<!-- ─── HEADER ─── -->
<header class="site-header">
    <div class="header-ray"></div>
    <div class="header-inner">
        <div class="header-logo-ring">
            <img src="{{ asset('storage/company-logos/logo-sgm.png') }}" alt="Logo SGM" />
        </div>
        <div>
            <div class="header-brand-name">PT. Sentra Gemilang Mulia</div>
            <div class="header-brand-sub">SGM Group &bull; Sistem Inventaris Aset</div>
        </div>
    </div>
</header>

<!-- ─── PAGE ─── -->
<main class="page">

    <!-- Title -->
    <div style="text-align:center;">
        <div class="page-eyebrow">Inventaris Aset</div>
        <div class="page-title">Scan QR Aset</div>
        <div class="page-desc">Arahkan kamera ke QR Code pada label aset SGM Group</div>
    </div>

    <!-- ── SCANNER CARD ── -->
    <div class="scanner-card" id="scannerCard">
        <div class="reader-wrap">
            <div id="reader"></div>
            <div class="scan-frame-overlay" id="scanOverlay">
                <div class="scan-frame">
                    <span class="corner-br"></span>
                    <span class="corner-bl"></span>
                    <div class="scan-laser"></div>
                </div>
            </div>
        </div>
        <div class="scanner-status-row" id="statusRow">
            <div class="scanner-live-dot" id="liveDot"></div>
            <div class="scanner-live-text" id="liveText">Kamera aktif &mdash; menunggu QR Code...</div>
        </div>
    </div>

    <!-- ── RESULT PANEL (hidden by default) ── -->
    <div class="result-panel" id="resultPanel">
        <div class="result-icon-area" id="resultIconArea">
            <!-- injected by JS -->
        </div>
        <div class="result-actions" id="resultActions">
            <!-- injected by JS -->
        </div>
    </div>

    <!-- Tips -->
    <div class="tips-card" id="tipsCard">
        <div class="tips-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div>
            <div class="tips-title">Tips Scanning</div>
            <div class="tips-body">Pastikan pencahayaan cukup dan QR Code tidak buram. Jaga jarak 10&ndash;20 cm dari label aset.</div>
        </div>
    </div>

</main>

<!-- ─── STICKY BOTTOM BAR ─── -->
<div class="bottom-bar">
    <div class="bottom-bar-inner">

        <a href="{{ route('home') }}" class="btn-bottom btn-bottom--home">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Beranda
        </a>

        @if(auth()->check())
        <a href="{{ url('/admin') }}" class="btn-bottom btn-bottom--admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 14L4 9l5-5"/><path d="M4 9h11a5 5 0 0 1 5 5v3"/>
            </svg>
            Dashboard Admin
        </a>
        @endif

    </div>
</div>

<!-- ─── SCRIPTS ─── -->
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
(function () {
    'use strict';

    let isProcessing = false;
    const html5QrCode = new Html5Qrcode("reader");

    /* ── URL validator ── */
    function isValidQrUrl(url) {
        try {
            const parsed = new URL(url);
            const allowedPaths = ['/scan/', '/asset/'];
            return (
                parsed.protocol === 'https:' &&
                parsed.hostname === window.location.hostname &&
                allowedPaths.some(p => parsed.pathname.startsWith(p))
            );
        } catch {
            return false;
        }
    }

    /* ── Start scanner ── */
    function startScanner() {
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: { width: 250, height: 250 } },
            onScanSuccess,
            () => {} // silent failure
        ).catch(err => {
            console.error('Camera error:', err);
            showCameraError();
        });
    }

    /* ── Scan success handler ── */
    async function onScanSuccess(decodedText) {
        if (isProcessing) return;

        console.log('QR detected:', decodedText);

        if (!isValidQrUrl(decodedText)) {
            isProcessing = true;
            try { await html5QrCode.stop(); } catch (e) {}
            showInvalidQR();
            return;
        }

        isProcessing = true;
        try { await html5QrCode.stop(); } catch (e) {}
        showSuccess(decodedText);

        setTimeout(() => { window.location.href = decodedText; }, 1800);
    }

    /* ── Restart scanner ── */
    async function restartScanner() {
        isProcessing = false;

        // hide result, show scanner
        document.getElementById('resultPanel').classList.remove('visible');
        document.getElementById('scannerCard').style.display = '';
        document.getElementById('tipsCard').style.display    = '';

        try {
            await startScanner();
        } catch (e) {
            console.error(e);
        }
    }
    window.restartScanner = restartScanner; // expose for onclick

    /* ── Show: SUCCESS ── */
    function showSuccess(url) {
        hideScannerShowResult();

        document.getElementById('resultIconArea').innerHTML = `
            <div class="result-icon-ring result-icon-ring--success">
                <div class="result-ripple"></div>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <div class="result-title result-title--success">QR Berhasil Dipindai</div>
            <div class="result-desc">Membuka informasi aset&hellip;</div>
            <div class="loading-dots">
                <span></span><span></span><span></span>
            </div>
        `;

        document.getElementById('resultActions').innerHTML = `
            <div style="text-align:center; font-size:0.72rem; color:var(--straw); padding:0.5rem 0 0.75rem;">
                Anda akan diarahkan secara otomatis
            </div>
        `;
    }

    /* ── Show: INVALID QR ── */
    function showInvalidQR() {
        hideScannerShowResult();

        document.getElementById('resultIconArea').innerHTML = `
            <div class="result-icon-ring result-icon-ring--error">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
            </div>
            <div class="result-title result-title--error">QR Tidak Valid</div>
            <div class="result-desc">QR ini bukan berasal dari sistem inventaris SGM Group.</div>
        `;

        document.getElementById('resultActions').innerHTML = `
            <button class="btn-result btn-result--primary" onclick="restartScanner()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M23 4v6h-6"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                </svg>
                Scan QR Lagi
            </button>
            <a href="{{ route('home') }}" class="btn-result btn-result--secondary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Kembali ke Beranda
            </a>
        `;
    }

    /* ── Show: CAMERA ERROR ── */
    function showCameraError() {
        hideScannerShowResult();

        document.getElementById('resultIconArea').innerHTML = `
            <div class="result-icon-ring result-icon-ring--error">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                    <line x1="2" y1="2" x2="22" y2="22"/>
                </svg>
            </div>
            <div class="result-title result-title--error">Kamera Tidak Bisa Diakses</div>
            <div class="result-desc">Izinkan akses kamera di browser Anda, lalu coba lagi.</div>
        `;

        document.getElementById('resultActions').innerHTML = `
            <button class="btn-result btn-result--primary" onclick="restartScanner()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M23 4v6h-6"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                </svg>
                Coba Lagi
            </button>
        `;
    }

    /* ── Toggle UI: scanner → result ── */
    function hideScannerShowResult() {
        document.getElementById('scannerCard').style.display = 'none';
        document.getElementById('tipsCard').style.display    = 'none';
        document.getElementById('resultPanel').classList.add('visible');
    }

    /* ── INIT ── */
    startScanner();
})();
</script>

</body>
</html>