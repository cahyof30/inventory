<x-filament-panels::page>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />

    <style>
        /* ─── Scoped tokens (namespaced supaya tidak bocor ke elemen Filament lain) ─── */
        .sgm-scan {
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

            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem 1rem 2rem;
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            color: var(--ink);
            isolation: isolate;
            animation: sgmFadeIn 0.5s ease both;
        }

        /* Dark mode Filament: tetap kontras, tidak ikut gelap polos */
        .dark .sgm-scan {
            --cream: #1c1206;
            --white: #2a1c0c;
            --ink: #FBEFD9;
            --mahogany: #FFE8B8;
            --straw: #D8B988;
            --border: rgba(245,168,0,0.32);
            --border-soft: rgba(245,168,0,0.14);
            color: var(--ink);
        }

        @keyframes sgmFadeIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }

        /* ─── Ambient sun-ray (versi ringan, hanya dekorasi di belakang card) ─── */
        .sgm-scan .sgm-sun-bg {
            position: absolute;
            inset: -2rem -1rem auto -1rem;
            height: 380px;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
            border-radius: 24px;
        }
        .sgm-scan .sgm-sun-bg svg {
            position: absolute;
            top: -60%;
            left: 50%;
            transform: translateX(-50%);
            width: 160vw;
            max-width: 1100px;
            opacity: 0.35;
        }
        .dark .sgm-scan .sgm-sun-bg svg { opacity: 0.18; }

        /* ─── Title block ─── */
        .sgm-scan .sgm-title-block { position: relative; z-index: 1; text-align: center; }
        .sgm-scan .sgm-eyebrow {
            font-size: 0.65rem; font-weight: 600; color: var(--straw);
            letter-spacing: 0.16em; text-transform: uppercase;
        }
        .sgm-scan .sgm-title {
            font-family: 'Playfair Display', ui-serif, Georgia, serif;
            font-size: clamp(1.25rem, 4vw, 1.6rem);
            font-weight: 700; color: var(--mahogany);
            margin-top: 0.25rem; line-height: 1.2;
        }
        .sgm-scan .sgm-desc {
            font-size: 0.8rem; color: var(--straw); line-height: 1.6;
            max-width: 30ch; margin: 0.4rem auto 0;
        }

        /* ─── Scanner card ─── */
        .sgm-scan .scanner-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 420px;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(245,168,0,0.12);
        }

        .sgm-scan .reader-wrap {
            position: relative;
            background: #0d0a05;
            overflow: hidden;
        }

        .sgm-scan #reader { width: 100% !important; }
        .sgm-scan #reader img { display: none !important; }
        .sgm-scan #reader__scan_region { border: none !important; }
        .sgm-scan #reader__dashboard { display: none !important; }

        .sgm-scan .scan-frame-overlay {
            position: absolute; inset: 0; pointer-events: none;
            display: flex; align-items: center; justify-content: center;
        }
        .sgm-scan .scan-frame { position: relative; width: 200px; height: 200px; }

        .sgm-scan .scan-frame::before,
        .sgm-scan .scan-frame::after,
        .sgm-scan .scan-frame .corner-br,
        .sgm-scan .scan-frame .corner-bl {
            content: ''; position: absolute; width: 28px; height: 28px;
            border-color: var(--gold); border-style: solid;
        }
        .sgm-scan .scan-frame::before    { top:0;    left:0;  border-width: 3px 0 0 3px; border-radius: 4px 0 0 0; }
        .sgm-scan .scan-frame::after     { top:0;    right:0; border-width: 3px 3px 0 0; border-radius: 0 4px 0 0; }
        .sgm-scan .scan-frame .corner-br { bottom:0; right:0; border-width: 0 3px 3px 0; border-radius: 0 0 4px 0; }
        .sgm-scan .scan-frame .corner-bl { bottom:0; left:0;  border-width: 0 0 3px 3px; border-radius: 0 0 0 4px; }

        .sgm-scan .scan-laser {
            position: absolute; left: 4px; right: 4px; top: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--ember), var(--gold), transparent);
            border-radius: 99px;
            animation: sgmLaserScan 2s ease-in-out infinite;
            box-shadow: 0 0 8px rgba(245,168,0,0.6);
        }
        @keyframes sgmLaserScan {
            0%   { top: 4px;   opacity: 1; }
            48%  { opacity: 1; }
            50%  { top: 192px; opacity: 0.8; }
            52%  { opacity: 1; }
            100% { top: 4px;   opacity: 1; }
        }

        .sgm-scan .scanner-status-row {
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.85rem 1.25rem;
            border-top: 1px solid var(--border-soft);
            background: var(--white);
        }
        .sgm-scan .scanner-live-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--success);
            animation: sgmLiveBlink 1.4s ease-in-out infinite;
        }
        @keyframes sgmLiveBlink { 0%,100%{opacity:1} 50%{opacity:0.3} }
        .sgm-scan .scanner-live-text { font-size: 0.75rem; font-weight: 500; color: var(--straw); }

        /* ─── Result panel ─── */
        .sgm-scan .result-panel {
            display: none;
            position: relative; z-index: 1;
            width: 100%; max-width: 420px;
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            border: 1.5px solid var(--border);
            box-shadow: 0 8px 40px rgba(245,168,0,0.12);
            animation: sgmPopIn 0.4s cubic-bezier(.22,.68,0,1.3) both;
        }
        @keyframes sgmPopIn { from{opacity:0;transform:scale(0.88)} to{opacity:1;transform:scale(1)} }
        .sgm-scan .result-panel.visible { display: block; }

        .sgm-scan .result-icon-area {
            padding: 2rem 1.5rem 1.25rem;
            display: flex; flex-direction: column; align-items: center; gap: 0.5rem;
        }
        .sgm-scan .result-icon-ring {
            width: 80px; height: 80px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            position: relative;
        }
        .sgm-scan .result-icon-ring svg { width: 40px; height: 40px; }
        .sgm-scan .result-icon-ring--success { background: var(--success-bg); border: 2px solid rgba(5,150,105,0.2); }
        .sgm-scan .result-icon-ring--success svg { color: var(--success); }
        .sgm-scan .result-icon-ring--error { background: var(--danger-bg); border: 2px solid rgba(220,38,38,0.2); }
        .sgm-scan .result-icon-ring--error svg { color: var(--danger); }

        .sgm-scan .result-ripple {
            position: absolute; inset: -6px; border-radius: 50%;
            border: 2px solid var(--success); opacity: 0;
            animation: sgmRippleOut 1.2s ease-out infinite 0.2s;
        }
        @keyframes sgmRippleOut {
            0%   { transform:scale(0.9); opacity:0.6; }
            100% { transform:scale(1.5); opacity:0; }
        }

        .sgm-scan .result-title {
            font-family: 'Playfair Display', ui-serif, Georgia, serif;
            font-size: 1.2rem; font-weight: 700; text-align: center; line-height: 1.2;
        }
        .sgm-scan .result-title--success { color: var(--success); }
        .sgm-scan .result-title--error   { color: var(--danger); }

        .sgm-scan .result-desc {
            font-size: 0.8rem; color: var(--straw); text-align: center; line-height: 1.55;
            max-width: 26ch; margin: 0 auto;
        }

        .sgm-scan .loading-dots { display: flex; gap: 5px; margin-top: 0.5rem; }
        .sgm-scan .loading-dots span { width: 7px; height: 7px; border-radius: 50%; background: var(--success); opacity: 0.3; }
        .sgm-scan .loading-dots span:nth-child(1) { animation: sgmDotPulse 1.2s ease-in-out infinite 0.0s; }
        .sgm-scan .loading-dots span:nth-child(2) { animation: sgmDotPulse 1.2s ease-in-out infinite 0.2s; }
        .sgm-scan .loading-dots span:nth-child(3) { animation: sgmDotPulse 1.2s ease-in-out infinite 0.4s; }
        @keyframes sgmDotPulse { 0%,100%{opacity:0.3} 50%{opacity:1} }

        .sgm-scan .result-actions { padding: 0 1.25rem 1.5rem; display: flex; flex-direction: column; gap: 0.6rem; }

        .sgm-scan .btn-result {
            width: 100%; height: 46px; border-radius: 12px; border: none; cursor: pointer;
            font-family: 'Inter', ui-sans-serif, sans-serif; font-size: 0.85rem; font-weight: 600;
            display: flex; align-items: center; justify-content: center; gap: 0.45rem;
            text-decoration: none; transition: opacity 0.2s, transform 0.15s;
        }
        .sgm-scan .btn-result:active { transform: scale(0.97); }
        .sgm-scan .btn-result svg { width: 18px; height: 18px; }
        .sgm-scan .btn-result--primary { background: linear-gradient(135deg, var(--gold), var(--ember)); color: #fff; }
        .sgm-scan .btn-result--secondary { background: var(--white); color: var(--mahogany); border: 1.5px solid var(--border); }
        .sgm-scan .btn-result--secondary:hover { background: var(--gold-light); }
        .dark .sgm-scan .btn-result--secondary:hover { background: rgba(245,168,0,0.12); }

        /* ─── Tips card ─── */
        .sgm-scan .tips-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 420px; display: flex; gap: 0.75rem;
            padding: 0.9rem 1.1rem; background: var(--white);
            border: 1.5px solid var(--border); border-radius: 16px;
        }
        .sgm-scan .tips-icon {
            width: 34px; height: 34px; border-radius: 9px; background: var(--gold-light);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .dark .sgm-scan .tips-icon { background: rgba(245,168,0,0.16); }
        .sgm-scan .tips-icon svg { width: 17px; height: 17px; color: var(--gold-deep); }
        .sgm-scan .tips-title { font-size: 0.75rem; font-weight: 600; color: var(--mahogany); margin-bottom: 0.15rem; }
        .sgm-scan .tips-body  { font-size: 0.7rem; color: var(--straw); line-height: 1.55; }

        @media (max-width: 480px) {
            .sgm-scan .scan-frame { width: 170px; height: 170px; }
            @keyframes sgmLaserScan {
                0%   { top:4px;   opacity:1; }
                50%  { top:162px; opacity:0.8; }
                100% { top:4px;   opacity:1; }
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .sgm-scan, .sgm-scan * {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>

    <div class="sgm-scan">

        <!-- Ambient sun-ray (dekorasi, di belakang card) -->
        <div class="sgm-sun-bg" aria-hidden="true">
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

        <!-- Title -->
        <div class="sgm-title-block">
            <div class="sgm-eyebrow">Inventaris Aset</div>
            <div class="sgm-title">Scan QR Aset</div>
            <div class="sgm-desc">Arahkan kamera ke QR Code pada label aset</div>
        </div>

        <!-- Scanner card -->
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

        <!-- Result panel (hidden by default) -->
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

    </div>

    @push('scripts')
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

            document.getElementById('resultPanel').classList.remove('visible');
            document.getElementById('scannerCard').style.display = '';
            document.getElementById('tipsCard').style.display    = '';

            try {
                await startScanner();
            } catch (e) {
                console.error(e);
            }
        }
        window.restartScanner = restartScanner; // expose untuk onclick

        /* ── Show: SUCCESS ── */
        function showSuccess() {
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
                <button type="button" class="btn-result btn-result--primary" onclick="restartScanner()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 4v6h-6"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                    </svg>
                    Scan QR Lagi
                </button>
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
                <button type="button" class="btn-result btn-result--primary" onclick="restartScanner()">
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
    @endpush

</x-filament-panels::page>