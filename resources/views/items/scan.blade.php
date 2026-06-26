<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Informasi Aset &mdash; SGM Group</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold:       #F5A800;
            --gold-deep:  #D48900;
            --gold-light: #FFF0C2;
            --ember:      #D94F00;
            --cream:      #FFFBF3;
            --straw:      #8B5E3C;
            --mahogany:   #3D1C02;
            --ink:        #1A0A00;
            --white:      #FFFFFF;
            --border:     rgba(245,168,0,0.2);
            --border-soft:rgba(61,28,2,0.08);
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--cream);
            font-family: 'Inter', sans-serif;
            color: var(--ink);
            min-height: 100vh;
            padding-bottom: 88px; /* space for sticky footer */
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
            background: var(--white);
            border: 2px solid var(--gold);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; overflow: hidden;
        }

        .header-logo-ring img { width: 26px; height: 26px; object-fit: contain; }

        .header-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--mahogany);
            line-height: 1.1;
        }

        .header-brand-sub {
            font-size: 0.6rem;
            font-weight: 500;
            color: var(--straw);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* ─── PAGE WRAPPER ─── */
        .page {
            max-width: 680px;
            margin: 0 auto;
            padding: 1.5rem 1.25rem 0;
            animation: fadeIn 0.5s ease both;
        }

        @keyframes fadeIn { from { opacity:0; transform: translateY(10px); } to { opacity:1; transform:translateY(0); } }

        /* ─── SEARCH BAR ─── */
        .search-wrap {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .search-wrap input {
            flex: 1;
            height: 44px;
            padding: 0 1rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            background: var(--white);
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            color: var(--ink);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .search-wrap input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(245,168,0,0.15);
        }

        .search-wrap input::placeholder { color: var(--straw); opacity: 0.7; }

        .btn-search {
            height: 44px;
            padding: 0 1.25rem;
            background: linear-gradient(135deg, var(--gold), var(--ember));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: opacity 0.2s, transform 0.15s;
            white-space: nowrap;
        }

        .btn-search:hover  { opacity: 0.9; }
        .btn-search:active { transform: scale(0.97); }

        /* ─── ALERT ─── */
        .alert-error {
            background: #FFF0F0;
            border: 1px solid #FFCACA;
            color: #A32D2D;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.82rem;
            text-align: center;
            margin-bottom: 1.25rem;
        }

        /* ─── ASSET CARD ─── */
        .asset-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
        }

        /* Company logo area */
        .company-logo-area {
            background: linear-gradient(180deg, var(--gold-light) 0%, var(--cream) 100%);
            padding: 1.25rem 1.25rem 0;
            display: flex;
            justify-content: center;
        }

        .company-logo-area img {
            height: 64px;
            object-fit: contain;
        }

        /* Asset image hero */
        .asset-image-hero {
            padding: 1.25rem 1.25rem 0;
            display: flex;
            justify-content: center;
        }

        .asset-image-frame {
            position: relative;
            display: inline-flex;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 0 0 3px var(--gold), 0 8px 32px rgba(213,137,0,0.18);
        }

        .asset-image-frame img {
            display: block;
            height: 240px;
            width: auto;
            max-width: 100%;
            object-fit: cover;
            border-radius: 14px;
        }

        /* Verified badge overlay */
        .verified-overlay {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(16,185,129,0.3);
            border-radius: 99px;
            padding: 0.25rem 0.65rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.65rem;
            font-weight: 600;
            color: #0a6640;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .verified-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #22c55e;
            animation: blink 2s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.4; }
        }

        /* Card header text */
        .asset-card-header {
            padding: 1.25rem 1.5rem 0;
            text-align: center;
        }

        .asset-section-label {
            font-size: 0.62rem;
            font-weight: 600;
            color: var(--straw);
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .asset-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--mahogany);
            margin-top: 0.25rem;
        }

        /* ─── DATA ROWS ─── */
        .data-section {
            padding: 1.25rem 1.5rem;
        }

        .data-row {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-soft);
            animation: rowIn 0.4s ease both;
        }

        .data-row:last-child { border-bottom: none; }

        @keyframes rowIn { from { opacity:0; transform:translateX(-8px); } to { opacity:1; transform:translateX(0); } }

        .data-row:nth-child(1)  { animation-delay: 0.05s; }
        .data-row:nth-child(2)  { animation-delay: 0.10s; }
        .data-row:nth-child(3)  { animation-delay: 0.15s; }
        .data-row:nth-child(4)  { animation-delay: 0.20s; }
        .data-row:nth-child(5)  { animation-delay: 0.25s; }

        .data-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: var(--gold-light);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .data-icon svg { width: 16px; height: 16px; color: var(--gold-deep); }

        .data-label {
            font-size: 0.7rem;
            font-weight: 500;
            color: var(--straw);
            letter-spacing: 0.04em;
            margin-bottom: 0.1rem;
        }

        .data-value {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--ink);
            line-height: 1.3;
        }

        /* status badge */
        .badge-verified {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.28rem 0.75rem;
            border-radius: 99px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .badge-good    { background:#d1fae5; color:#065f46; border:1px solid #a7f3d0; }
        .badge-broken  { background:#fee2e2; color:#991b1b; border:1px solid #fca5a5; }

        /* ─── DIVIDER ─── */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            margin: 0 1.5rem;
            opacity: 0.5;
        }

        /* ─── ACCORDION ─── */
        .accordion-trigger {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            width: 100%;
            padding: 0.9rem 1.5rem;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--mahogany);
            border-top: 1.5px dashed rgba(245,168,0,0.35);
            transition: background 0.2s, color 0.2s;
        }

        .accordion-trigger:hover { background: var(--gold-light); }
        .accordion-trigger:active { background: rgba(245,168,0,0.15); }

        .accordion-trigger .chevron {
            width: 18px; height: 18px;
            transition: transform 0.35s cubic-bezier(.22,.68,0,1.2);
            color: var(--gold-deep);
            flex-shrink: 0;
        }

        .accordion-trigger[aria-expanded="true"] .chevron { transform: rotate(180deg); }

        .accordion-trigger .lock-icon { width: 16px; height: 16px; color: var(--ember); }

        .accordion-body {
            display: none;
            padding: 0 0 0.5rem;
            background: linear-gradient(180deg, var(--gold-light) 0%, var(--cream) 100%);
        }

        .accordion-body.open { display: block; animation: accordionIn 0.3s ease both; }

        @keyframes accordionIn {
            from { opacity:0; transform:translateY(-6px); }
            to   { opacity:1; transform:translateY(0); }
        }

        .accordion-data-section { padding: 1rem 1.5rem; }

        .confidential-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.62rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--ember);
            padding: 0.25rem 0.6rem;
            background: rgba(217,79,0,0.08);
            border-radius: 99px;
            margin-bottom: 0.75rem;
        }

        /* ─── LOGIN PROMPT ─── */
        .login-prompt {
            margin: 0 1.5rem 1.25rem;
            border: 1.5px dashed rgba(245,168,0,0.4);
            border-radius: 12px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            background: linear-gradient(135deg, rgba(255,240,194,0.4), rgba(255,255,255,0.6));
        }

        .login-prompt-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            background: var(--gold-light);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .login-prompt-icon svg { width: 20px; height: 20px; color: var(--gold-deep); }

        .login-prompt-text {
            flex: 1;
        }

        .login-prompt-title {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--mahogany);
            margin-bottom: 0.15rem;
        }

        .login-prompt-sub {
            font-size: 0.7rem;
            color: var(--straw);
        }

        .login-prompt-btn {
            padding: 0.5rem 1rem;
            background: var(--mahogany);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
            transition: opacity 0.2s, transform 0.15s;
            display: inline-flex; align-items: center; gap: 0.3rem;
        }

        .login-prompt-btn:hover { opacity: 0.85; }
        .login-prompt-btn:active { transform: scale(0.97); }

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
            display: flex;
            gap: 0.75rem;
            max-width: 680px;
            margin: 0 auto;
        }

        .btn-bottom {
            flex: 1;
            height: 46px;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            display: flex; align-items: center; justify-content: center; gap: 0.4rem;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: transform 0.15s, opacity 0.2s;
        }

        .btn-bottom:active { transform: scale(0.97); }

        .btn-bottom--scan {
            background: linear-gradient(135deg, var(--gold), var(--ember));
            color: var(--white);
        }

        .btn-bottom--admin {
            background: var(--mahogany);
            color: var(--white);
        }

        .btn-bottom svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* ─── MOBILE ─── */
        @media (max-width: 480px) {
            .page { padding: 1rem 1rem 0; }
            .asset-image-frame img { height: 200px; }
            .data-section { padding: 1rem 1.25rem; }
            .asset-card-header { padding: 1rem 1.25rem 0; }
            .accordion-data-section { padding: 0.85rem 1.25rem; }
            .section-divider { margin: 0 1.25rem; }
            .login-prompt { margin: 0 1.25rem 1rem; }
            .bottom-bar { padding: 0.6rem 1rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>

<!-- ─── STICKY HEADER ─── -->
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

<!-- ─── PAGE CONTENT ─── -->
<div class="page">

    <!-- SEARCH FORM -->
    <form id="searchForm" action="{{ route('items.search') }}" method="POST" class="search-wrap">
        @csrf
        <input type="hidden" name="recaptchaToken" id="recaptchaToken" />
        <input
            type="text"
            name="code"
            placeholder="Cari kode aset lain..."
            required
        />
        <button class="btn-search" type="submit">Cari</button>
    </form>

    @if ($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <!-- ASSET CARD -->
    <div class="asset-card">

        {{-- Company logo band --}}
        <div class="company-logo-area">
            <img
                src="{{ asset('storage/'.$item->company?->logo) }}"
                alt="Logo {{ $item->company?->company_name }}"
            />
        </div>

        {{-- Asset image hero --}}
        <div class="asset-image-hero">
            <div class="asset-image-frame">
                <img
                    src="{{ $item->image ? asset('storage/'.$item->image) : asset('assets/no_picture.png') }}"
                    alt="Foto aset {{ $item->name }}"
                />
                <div class="verified-overlay">
                    <span class="verified-dot"></span>
                    Verified
                </div>
            </div>
        </div>

        {{-- Card header --}}
        <div class="asset-card-header">
            <div class="asset-section-label">Informasi Aset</div>
            <div class="asset-section-title">SGM Group</div>
        </div>

        {{-- Public data rows --}}
        <div class="data-section">

            <div class="data-row">
                <div class="data-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 8h10M7 12h6"/>
                    </svg>
                </div>
                <div>
                    <div class="data-label">Kode Barang</div>
                    <div class="data-value">{{ $item->code }}</div>
                </div>
            </div>

            <div class="data-row">
                <div class="data-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                    </svg>
                </div>
                <div>
                    <div class="data-label">Nama Barang</div>
                    <div class="data-value">{{ $item->name }} {{ $item->brand ?? '' }}</div>
                </div>
            </div>

            <div class="data-row">
                <div class="data-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
                <div>
                    <div class="data-label">Perusahaan</div>
                    <div class="data-value">{{ $item->company?->company_name }}</div>
                </div>
            </div>

            <div class="data-row">
                <div class="data-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <div>
                    <div class="data-label">Lokasi</div>
                    <div class="data-value">{{ $item->location?->name }}</div>
                </div>
            </div>

            <div class="data-row">
                <div class="data-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <div>
                        <div class="data-label">Kondisi</div>
                        @if ($item->condition == 'good')
                            <span class="badge-verified badge-good">Baik</span>
                        @elseif ($item->condition == 'broken')
                            <span class="badge-verified badge-broken">Rusak</span>
                        @endif
                    </div>
            </div>

        </div>{{-- /data-section --}}

        <div class="section-divider"></div>

        {{-- ── AUTHENTICATED: accordion ── --}}
        @if(auth()->check())

        <button
            class="accordion-trigger"
            type="button"
            id="accordionTrigger"
            aria-expanded="false"
            aria-controls="confidentialInfo"
        >
            <svg class="lock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            Lihat Informasi Lengkap
            <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </button>

        <div class="accordion-body" id="confidentialInfo" role="region" aria-labelledby="accordionTrigger">
            <div class="accordion-data-section">
                <div class="confidential-tag">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Data Rahasia
                </div>

                <div class="data-row">
                    <div class="data-icon" style="background:rgba(217,79,0,0.08);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#D94F00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>
                        </svg>
                    </div>
                    <div>
                        <div class="data-label">Harga Beli</div>
                        <div class="data-value">Rp {{ number_format($item->purchase_price, 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="data-row">
                    <div class="data-icon" style="background:rgba(217,79,0,0.08);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#D94F00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <div>
                        <div class="data-label">Tanggal Beli</div>
                        <div class="data-value">{{ \Carbon\Carbon::parse($item->purchase_date)->format('d F Y') }}</div>
                    </div>
                </div>

                <div class="data-row">
                    <div class="data-icon" style="background:rgba(217,79,0,0.08);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#D94F00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div>
                        <div class="data-label">Vendor</div>
                        <div class="data-value">{{ $item->vendor?->name ?? '-' }}</div>
                    </div>
                </div>

                <div class="data-row">
                    <div class="data-icon" style="background:rgba(217,79,0,0.08);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#D94F00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>
                        </svg>
                    </div>
                    <div>
                        <div class="data-label">Seri</div>
                        <div class="data-value">{{ $item->specification['seri'] ?? '-' }}</div>
                    </div>
                </div>

                <div class="data-row" style="border-bottom:none;">
                    <div class="data-icon" style="background:rgba(217,79,0,0.08);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#D94F00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                    </div>
                    
                </div>

            </div>{{-- /accordion-data-section --}}
        </div>{{-- /accordion-body --}}

        {{-- ── GUEST: login prompt ── --}}
        @else

        <div class="login-prompt">
            <div class="login-prompt-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>
            <div class="login-prompt-text">
                <div class="login-prompt-title">Informasi lengkap tersedia</div>
                <div class="login-prompt-sub">Login untuk lihat harga, vendor, dan kondisi aset</div>
            </div>
            <a href="{{ route('filament.admin.auth.login') }}" class="login-prompt-btn">
                Login
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        @endif

    </div>{{-- /asset-card --}}

</div>{{-- /page --}}

<!-- ─── STICKY BOTTOM BAR ─── -->
<div class="bottom-bar">
    <div class="bottom-bar-inner">

        <a href="{{ route('items.scan-camera') }}" class="btn-bottom btn-bottom--scan">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 12v4a1 1 0 0 1-1 1h-4m5-14h2a2 2 0 0 1 2 2v2m-4 1V7m4 10v2a2 2 0 0 1-2 2h-2M3 7V5a2 2 0 0 1 2-2h2m0 14h.01M7 21H5a2 2 0 0 1-2-2v-2"/>
                <rect width="5" height="5" x="7" y="7" rx="1"/>
            </svg>
            Scan QR Lain
        </a>

        @if(auth()->check())
        <a href="{{ url('/admin') }}" class="btn-bottom btn-bottom--admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Dashboard Admin
        </a>
        @endif

    </div>
</div>

<!-- ─── SCRIPTS ─── -->
<script>
    // Accordion toggle
    const trigger = document.getElementById('accordionTrigger');
    const body    = document.getElementById('confidentialInfo');

    if (trigger && body) {
        trigger.addEventListener('click', function () {
            const isOpen = trigger.getAttribute('aria-expanded') === 'true';
            trigger.setAttribute('aria-expanded', !isOpen);
            if (isOpen) {
                body.classList.remove('open');
            } else {
                body.classList.add('open');
            }
        });
    }
</script>

<!-- reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
    const form = document.getElementById('searchForm');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        grecaptcha.ready(function () {
            grecaptcha.execute(
                "{{ config('services.recaptcha.site_key') }}",
                { action: 'search_item' }
            ).then(function (token) {
                document.getElementById('recaptchaToken').value = token;
                form.submit();
            });
        });
    });
</script>

</body>
</html>