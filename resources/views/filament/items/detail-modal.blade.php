{{-- resources/views/filament/items/detail-modal.blade.php
     ─────────────────────────────────────────────────────
     Modal detail aset — SGM Group Theme
     Digunakan sebagai infolist / ViewAction modal di Filament.
     Semua class diawali "adm-" (asset-detail-modal) agar
     tidak bentrok dengan utility class Tailwind / Filament.
--}}

<style>
/* ── VARIABLES ── */
:root {
    --adm-gold:        #F5A800;
    --adm-gold-deep:   #D48900;
    --adm-gold-light:  #FFF0C2;
    --adm-ember:       #D94F00;
    --adm-cream:       #FFFBF3;
    --adm-straw:       #8B5E3C;
    --adm-mahogany:    #3D1C02;
    --adm-ink:         #1A0A00;
    --adm-white:       #FFFFFF;
    --adm-border:      rgba(245,168,0,0.22);
    --adm-border-soft: rgba(61,28,2,0.08);
    --adm-success:     #059669;
    --adm-success-bg:  #d1fae5;
    --adm-success-bd:  #a7f3d0;
}

/* ── ROOT WRAPPER ── */
.adm-root {
    font-family: 'Inter', ui-sans-serif, sans-serif;
    color: var(--adm-ink);
    overflow: hidden;
    border-radius: 12px;
    /* subtract filament modal's own padding */
    margin: -1.5rem;
}

/* ── GOLD TOP STRIP (animated) ── */
.adm-strip {
    height: 4px;
    background: linear-gradient(
        90deg,
        var(--adm-gold)  0%,
        var(--adm-ember) 50%,
        var(--adm-gold)  100%
    );
    background-size: 200% 100%;
    animation: admShift 4s linear infinite;
}
@keyframes admShift {
    0%   { background-position: 0%   50%; }
    100% { background-position: 200% 50%; }
}

/* ── HERO AREA ── */
.adm-hero {
    background: linear-gradient(180deg, var(--adm-gold-light) 0%, var(--adm-cream) 100%);
    padding: 1.5rem 1.5rem 1.25rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

/* Company logo */
.adm-company-logo {
    display: block;
    max-height: 54px;
    max-width: 160px;
    width: auto;
    object-fit: contain;
}

/* Asset image with gold ring */
.adm-asset-img-wrap {
    position: relative;
    display: inline-flex;
    border-radius: 14px;
    overflow: hidden;
    box-shadow:
        0 0 0 3px var(--adm-gold),
        0 6px 24px rgba(213,137,0,0.2);
    animation: admFadeIn 0.5s ease both;
}
@keyframes admFadeIn {
    from { opacity:0; transform: scale(0.96); }
    to   { opacity:1; transform: scale(1); }
}
.adm-asset-img {
    display: block;
    max-height: 220px;
    max-width: 100%;
    width: auto;
    object-fit: cover;
    border-radius: 12px;
}

/* Verified badge — overlaid on image bottom-right */
.adm-verified-badge {
    position: absolute;
    bottom: 8px;
    right: 8px;
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(4px);
    border: 1px solid rgba(16,185,129,0.3);
    border-radius: 999px;
    padding: 0.2rem 0.55rem;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.6rem;
    font-weight: 700;
    color: #065f46;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}
.adm-verified-dot {
    width: 5px; height: 5px;
    border-radius: 50%;
    background: #22c55e;
    animation: admBlink 2s ease-in-out infinite;
    flex-shrink: 0;
}
@keyframes admBlink { 0%,100%{opacity:1} 50%{opacity:0.3} }

/* Hero heading */
.adm-hero-label {
    font-size: 0.6rem;
    font-weight: 600;
    color: var(--adm-straw);
    letter-spacing: 0.16em;
    text-transform: uppercase;
    text-align: center;
}
.adm-hero-title {
    font-family: 'Playfair Display', Georgia, 'Times New Roman', serif;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--adm-mahogany);
    text-align: center;
    line-height: 1.2;
    margin-top: 0.15rem;
}
.adm-hero-divider {
    width: 36px; height: 2px;
    background: linear-gradient(90deg, var(--adm-gold), var(--adm-ember));
    border-radius: 999px;
    margin: 0.1rem auto 0;
}

/* ── DATA SECTION ── */
.adm-data {
    padding: 0.75rem 1.5rem 1.5rem;
    background: var(--adm-white);
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* Individual row */
.adm-row {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.7rem 0;
    border-bottom: 1px solid var(--adm-border-soft);
    animation: admRowIn 0.35s ease both;
}
.adm-row:last-child { border-bottom: none; }

@keyframes admRowIn {
    from { opacity:0; transform: translateX(-6px); }
    to   { opacity:1; transform: translateX(0); }
}
.adm-row:nth-child(1) { animation-delay: 0.05s; }
.adm-row:nth-child(2) { animation-delay: 0.10s; }
.adm-row:nth-child(3) { animation-delay: 0.15s; }
.adm-row:nth-child(4) { animation-delay: 0.20s; }
.adm-row:nth-child(5) { animation-delay: 0.25s; }

/* Icon bubble */
.adm-icon {
    width: 30px; height: 30px;
    border-radius: 7px;
    background: var(--adm-gold-light);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    margin-top: 1px;
}
.adm-icon svg {
    width: 14px; height: 14px;
    color: var(--adm-gold-deep);
}

/* Label + Value */
.adm-field { flex: 1; min-width: 0; }
.adm-label {
    font-size: 0.65rem;
    font-weight: 600;
    color: var(--adm-straw);
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 0.1rem;
    line-height: 1;
}
.adm-value {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--adm-ink);
    line-height: 1.4;
    word-break: break-word;
}

/* Status badge */
.adm-status {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.26rem 0.7rem;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    background: var(--adm-success-bg);
    color: var(--adm-success);
    border: 1px solid var(--adm-success-bd);
}
.adm-status svg {
    width: 10px; height: 10px;
}

/* ── RESPONSIVE ── */
@media (max-width: 480px) {
    .adm-hero  { padding: 1.1rem 1.1rem 1rem; }
    .adm-data  { padding: 0.5rem 1.1rem 1.1rem; }
    .adm-asset-img { max-height: 180px; }
    .adm-hero-title { font-size: 0.95rem; }
    .adm-value { font-size: 0.82rem; }
}
</style>

<div class="adm-root">

    {{-- ── ANIMATED GOLD STRIP ── --}}
    <div class="adm-strip" aria-hidden="true"></div>

    {{-- ── HERO ── --}}
    <div class="adm-hero">

        {{-- Company logo --}}
        @if($record->company?->logo)
            <img
                src="{{ asset('storage/' . $record->company->logo) }}"
                alt="{{ $record->company?->company_name }}"
                class="adm-company-logo"
            />
        @endif

        {{-- Asset image with gold ring + verified badge --}}
        <div class="adm-asset-img-wrap">
            <img
                src="{{ $record->image
                    ? asset('storage/' . $record->image)
                    : asset('assets/no_picture.png') }}"
                alt="{{ $record->name }}"
                class="adm-asset-img"
            />
            <div class="adm-verified-badge">
                <span class="adm-verified-dot"></span>
                Verified
            </div>
        </div>

        {{-- Heading --}}
        <div>
            <div class="adm-hero-label">Informasi Aset</div>
            <div class="adm-hero-title">SGM Group</div>
            <div class="adm-hero-divider"></div>
        </div>

    </div>

    {{-- ── DATA ROWS ── --}}
    <div class="adm-data">

        {{-- Kode Barang --}}
        <div class="adm-row">
            <div class="adm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                    <path d="M7 8h10M7 12h6"/>
                </svg>
            </div>
            <div class="adm-field">
                <div class="adm-label">Kode Barang</div>
                <div class="adm-value">{{ $record->code }}</div>
            </div>
        </div>

        {{-- Nama Barang --}}
        <div class="adm-row">
            <div class="adm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
            </div>
            <div class="adm-field">
                <div class="adm-label">Nama Barang</div>
                <div class="adm-value">{{ $record->name }} {{ $record->brand ?? '' }} {{ $record->specification['seri'] ?? '' }}</div>
            </div>
        </div>

        {{-- Perusahaan --}}
        <div class="adm-row">
            <div class="adm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
            </div>
            <div class="adm-field">
                <div class="adm-label">Perusahaan</div>
                <div class="adm-value">{{ $record->company?->company_name ?? '-' }}</div>
            </div>
        </div>

        {{-- Lokasi --}}
        <div class="adm-row">
            <div class="adm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
            </div>
            <div class="adm-field">
                <div class="adm-label">Lokasi</div>
                <div class="adm-value">{{ $record->location?->name ?? '-' }}</div>
            </div>
        </div>

        {{-- Status --}}
        <div class="adm-row">
            <div class="adm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <div class="adm-field">
                <div class="adm-label">Status</div>
                <span class="adm-status">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor"
                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 6l3 3 5-5"/>
                    </svg>
                    Verified
                </span>
            </div>
        </div>

    </div>

</div>