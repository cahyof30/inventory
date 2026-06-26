{{--
    SGM Group — Custom Filament Login View
    Simpan di: resources/views/filament/pages/auth/sgm-login.blade.php

    Wajib menggunakan <x-filament-panels::page> agar Livewire form bekerja.
    Seluruh CSS ditulis inline dalam tag <style> sehingga tidak bergantung
    pada build step Vite atau asset pipeline Filament.

    Cara pakai:
    1. Simpan file ini di resources/views/filament/pages/auth/sgm-login.blade.php
    2. Simpan Login.php di app/Filament/Pages/Auth/Login.php
    3. Di AdminPanelProvider.php tambahkan:
         ->login(\App\Filament\Pages\Auth\Login::class)
--}}
{{-- ════════════════════════════════════════════════════
     INJEKSI CSS + OVERRIDE ke HEAD filament
     Gunakan renderHook di panel provider jika mau pisah file:
     ->renderHook('panels::head.end', fn() => view('filament.login-styles'))
     Tapi inline sudah cukup untuk keep-it-simple.
════════════════════════════════════════════════════ --}}
@push('styles')
<style>
/* ────────── VARIABLES SGM ────────── */
:root {
    --sgm-gold:       #F5A800;
    --sgm-gold-deep:  #D48900;
    --sgm-gold-light: #FFF0C2;
    --sgm-ember:      #D94F00;
    --sgm-cream:      #FFFBF3;
    --sgm-straw:      #8B5E3C;
    --sgm-mahogany:   #3D1C02;
    --sgm-ink:        #1A0A00;
    --sgm-white:      #FFFFFF;
    --sgm-border:     rgba(245,168,0,0.22);
}

/* ────────── FULL PAGE OVERRIDE ────────── */
/* Filament membungkus halaman auth dengan fi-simple-layout;
   kita reset dan rebuild dari atas */
.fi-simple-layout {
    background: var(--sgm-cream) !important;
    min-height: 100vh !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    position: relative !important;
    overflow: hidden !important;
    padding: 1.5rem !important;
    font-family: 'Inter', ui-sans-serif, sans-serif !important;
}

/* Pastikan body tidak berwarna hitam */
body, html {
    background: var(--sgm-cream) !important;
}

/* ────────── SUN RAY BACKGROUND ────────── */
.sgm-sun-bg {
    position: fixed;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    overflow: hidden;
}
.sgm-sun-bg svg {
    position: absolute;
    top: -55%;
    left: 50%;
    transform: translateX(-50%);
    width: 200%;
    opacity: 1;
}

/* ────────── WRAPPER UTAMA ────────── */
.sgm-login-wrap {
    position: relative;
    z-index: 10;
    width: 100%;
    max-width: 420px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
}

/* ────────── BRAND HEADER ────────── */
.sgm-brand {
    text-align: center;
    animation: sgmSlideDown 0.7s cubic-bezier(.22,.68,0,1.2) both;
}
@keyframes sgmSlideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.sgm-logo-ring {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--sgm-white);
    box-shadow: 0 0 0 4px var(--sgm-gold), 0 8px 32px rgba(213,137,0,0.22);
    margin-bottom: 1rem;
    overflow: hidden;
}
.sgm-logo-ring img {
    width: 58px;
    height: 58px;
    object-fit: contain;
}
.sgm-company-name {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--sgm-mahogany);
    letter-spacing: -0.01em;
    line-height: 1.2;
}
.sgm-company-sub {
    font-size: 0.65rem;
    font-weight: 500;
    color: var(--sgm-straw);
    letter-spacing: 0.14em;
    text-transform: uppercase;
    margin-top: 0.3rem;
}
.sgm-divider {
    width: 36px;
    height: 2px;
    background: linear-gradient(90deg, var(--sgm-gold), var(--sgm-ember));
    border-radius: 99px;
    margin: 0.75rem auto 0;
}
.sgm-system-tag {
    display: inline-block;
    margin-top: 0.55rem;
    font-size: 0.62rem;
    font-weight: 600;
    color: var(--sgm-white);
    background: var(--sgm-ember);
    letter-spacing: 0.14em;
    text-transform: uppercase;
    padding: 0.28rem 0.75rem;
    border-radius: 99px;
}

/* ────────── FORM CARD ────────── */
.sgm-form-card {
    width: 100%;
    background: var(--sgm-white);
    border: 1.5px solid var(--sgm-border);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 40px rgba(245,168,0,0.12);
    animation: sgmSlideUp 0.75s cubic-bezier(.22,.68,0,1.2) 0.25s both;
}
@keyframes sgmSlideUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Gold top strip */
.sgm-card-strip {
    height: 3px;
    background: linear-gradient(90deg, var(--sgm-gold) 0%, var(--sgm-ember) 50%, var(--sgm-gold) 100%);
    background-size: 200% 100%;
    animation: sgmShiftRay 4s linear infinite;
}
@keyframes sgmShiftRay {
    0%   { background-position: 0%   50%; }
    100% { background-position: 200% 50%; }
}

/* Card heading area */
.sgm-card-header {
    padding: 1.5rem 1.75rem 0;
    text-align: center;
}
.sgm-card-heading {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--sgm-mahogany);
    margin-bottom: 0.2rem;
}
.sgm-card-sub {
    font-size: 0.72rem;
    color: var(--sgm-straw);
    line-height: 1.5;
}

/* Form body */
.sgm-form-body {
    padding: 1.25rem 1.75rem 1.75rem;
}

/* ────────── OVERRIDE FILAMENT FORM ELEMENTS ────────── */
/* Label */
.fi-fo-field-wrp-label label,
.fi-label {
    color: var(--sgm-mahogany) !important;
    font-size: 0.78rem !important;
    font-weight: 600 !important;
    letter-spacing: 0.02em !important;
    font-family: 'Inter', ui-sans-serif, sans-serif !important;
}

/* Input */
.fi-input {
    background: var(--sgm-cream) !important;
    border-color: rgba(245,168,0,0.35) !important;
    border-radius: 10px !important;
    color: var(--sgm-ink) !important;
    font-family: 'Inter', ui-sans-serif, sans-serif !important;
    font-size: 0.875rem !important;
    transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
}
.fi-input:focus {
    border-color: var(--sgm-gold) !important;
    box-shadow: 0 0 0 3px rgba(245,168,0,0.18) !important;
    outline: none !important;
}
.fi-input-wrp {
    border-radius: 10px !important;
    border-color: rgba(245,168,0,0.35) !important;
}
.fi-input-wrp:focus-within {
    border-color: var(--sgm-gold) !important;
    box-shadow: 0 0 0 3px rgba(245,168,0,0.18) !important;
}

/* Icon inside input */
.fi-input-wrp .fi-input-prefix-icon,
.fi-input-wrp .fi-input-suffix-icon {
    color: var(--sgm-gold-deep) !important;
}

/* Submit Button */
.fi-btn-color-primary,
.fi-btn[data-color="primary"] {
    background: linear-gradient(135deg, var(--sgm-gold), var(--sgm-ember)) !important;
    color: var(--sgm-white) !important;
    border: none !important;
    border-radius: 12px !important;
    font-family: 'Inter', ui-sans-serif, sans-serif !important;
    font-weight: 600 !important;
    font-size: 0.875rem !important;
    letter-spacing: 0.02em !important;
    height: 46px !important;
    transition: opacity 0.2s, transform 0.15s !important;
    box-shadow: 0 4px 16px rgba(245,168,0,0.25) !important;
}
.fi-btn-color-primary:hover,
.fi-btn[data-color="primary"]:hover {
    opacity: 0.92 !important;
}
.fi-btn-color-primary:active,
.fi-btn[data-color="primary"]:active {
    transform: scale(0.98) !important;
}

/* Checkbox / Remember me */
.fi-checkbox-input {
    accent-color: var(--sgm-gold) !important;
}

/* Error messages */
.fi-fo-field-wrp-error-message {
    color: var(--sgm-ember) !important;
    font-size: 0.72rem !important;
}

/* Filament notification / validation alert */
.fi-fo-field-wrp .fi-fo-field-wrp-error-message {
    color: var(--sgm-ember) !important;
}

/* "Forgot password" link */
.fi-link,
a.fi-link {
    color: var(--sgm-gold-deep) !important;
    font-size: 0.78rem !important;
    font-weight: 500 !important;
}
.fi-link:hover,
a.fi-link:hover {
    color: var(--sgm-ember) !important;
}

/* Filament simple layout main element */
.fi-simple-main {
    width: 100% !important;
    max-width: 420px !important;
    background: transparent !important;
    box-shadow: none !important;
    border: none !important;
    border-radius: 0 !important;
    padding: 0 !important;
}

/* ────────── FOOTER ────────── */
.sgm-footer {
    text-align: center;
    animation: sgmFadeIn 0.6s ease 1.1s both;
}
@keyframes sgmFadeIn { from { opacity:0; } to { opacity:1; } }
.sgm-footer p {
    font-size: 0.65rem;
    color: var(--sgm-straw);
    opacity: 0.7;
    line-height: 1.7;
}
.sgm-footer strong {
    font-weight: 600;
    color: var(--sgm-mahogany);
}
.sgm-footer-dot {
    display: inline-block;
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: var(--sgm-gold);
    margin: 0 0.35rem;
    vertical-align: middle;
}

/* ────────── GOOGLE FONT LOAD ────────── */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap');

/* ────────── RESPONSIF ────────── */
@media (max-width: 480px) {
    .sgm-logo-ring    { width: 68px; height: 68px; }
    .sgm-logo-ring img{ width: 48px; height: 48px; }
    .sgm-company-name { font-size: 1.1rem; }
    .sgm-card-header  { padding: 1.25rem 1.25rem 0; }
    .sgm-form-body    { padding: 1.1rem 1.25rem 1.5rem; }
    .fi-simple-layout { padding: 1.25rem 1rem !important; }
}
</style>
@endpush

{{-- ════════════════════════════════════════════════════
     HTML STRUCTURE
════════════════════════════════════════════════════ --}}
<div>
{{-- Sun Ray Background --}}
<div class="sgm-sun-bg" aria-hidden="true">
    <svg viewBox="0 0 1200 700" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(600,0)">
            <line x1="0" y1="0" x2="-580" y2="700" stroke="#F5A800" stroke-width="70" stroke-opacity="0.08"/>
            <line x1="0" y1="0" x2="-420" y2="700" stroke="#D94F00" stroke-width="50" stroke-opacity="0.06"/>
            <line x1="0" y1="0" x2="-270" y2="700" stroke="#F5A800" stroke-width="60" stroke-opacity="0.08"/>
            <line x1="0" y1="0" x2="-130" y2="700" stroke="#D94F00" stroke-width="40" stroke-opacity="0.05"/>
            <line x1="0" y1="0" x2="-40"  y2="700" stroke="#F5A800" stroke-width="65" stroke-opacity="0.08"/>
            <line x1="0" y1="0" x2="0"    y2="700" stroke="#F5A800" stroke-width="48" stroke-opacity="0.06"/>
            <line x1="0" y1="0" x2="40"   y2="700" stroke="#D94F00" stroke-width="68" stroke-opacity="0.08"/>
            <line x1="0" y1="0" x2="130"  y2="700" stroke="#F5A800" stroke-width="44" stroke-opacity="0.06"/>
            <line x1="0" y1="0" x2="270"  y2="700" stroke="#D94F00" stroke-width="62" stroke-opacity="0.08"/>
            <line x1="0" y1="0" x2="420"  y2="700" stroke="#F5A800" stroke-width="46" stroke-opacity="0.07"/>
            <line x1="0" y1="0" x2="580"  y2="700" stroke="#D94F00" stroke-width="70" stroke-opacity="0.08"/>
        </g>
    </svg>
</div>

{{-- Main Wrapper --}}
<div class="sgm-login-wrap">

    {{-- ── BRAND HEADER ── --}}
    <div class="sgm-brand">
        <div class="sgm-logo-ring">
            <img src="{{ asset('storage/company-logos/logo-sgm.png') }}" alt="Logo PT. Sentra Gemilang Mulia" />
        </div>
        <div class="sgm-company-name">PT. Sentra Gemilang Mulia</div>
        <div class="sgm-company-sub">SGM Group</div>
        <div class="sgm-divider"></div>
        <span class="sgm-system-tag">Sistem Inventaris Aset</span>
    </div>

    {{-- ── FORM CARD ── --}}
    <div class="sgm-form-card">

        {{-- Animated gold top strip --}}
        <div class="sgm-card-strip" aria-hidden="true"></div>

        {{-- Card heading --}}
        <div class="sgm-card-header">
            <div class="sgm-card-heading">Selamat Datang Kembali</div>
            <div class="sgm-card-sub">Masuk untuk mengakses dasbor inventaris aset</div>
        </div>

        {{-- Filament Login Form — INI WAJIB ADA, jangan dihapus --}}
        <div class="sgm-form-body">
            <form wire:submit="authenticate">
                {{-- Field email, password, remember me di-render oleh Filament --}}
                {{ $this->form }}

                <button
                    type="submit"
                    style="
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 0.4rem;
                        width: 100%;
                        background: linear-gradient(135deg, #F5A800, #D94F00);
                        color: #fff;
                        border: none;
                        border-radius: 12px;
                        font-weight: 600;
                        font-size: 0.875rem;
                        letter-spacing: 0.02em;
                        height: 46px;
                        margin-top: 0.75rem;
                        box-shadow: 0 4px 16px rgba(245,168,0,0.25);
                        cursor: pointer;
                        transition: opacity 0.2s, transform 0.15s;
                    "
                    onmouseover="this.style.opacity='0.92'"
                    onmouseout="this.style.opacity='1'"
                >
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                    Masuk ke Sistem
                </button>
            </form>

            {{-- Back to homepage --}}
            <div style="
                text-align: center;
                margin-top: 1.1rem;
                padding-top: 1rem;
                border-top: 1px solid rgba(245,168,0,0.18);
            ">
                <a href="{{ route('home') }}"
                   style="
                       font-size: 0.75rem;
                       color: #8B5E3C;
                       text-decoration: none;
                       display: inline-flex;
                       align-items: center;
                       gap: 0.35rem;
                       font-weight: 500;
                       transition: color 0.2s;
                   "
                   onmouseover="this.style.color='#D94F00'"
                   onmouseout="this.style.color='#8B5E3C'"
                >
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

    </div>

    {{-- ── FOOTER ── --}}
    <footer class="sgm-footer">
        <p>
            &copy; {{ date('Y') }} <strong>PT. Sentra Gemilang Mulia</strong>
            <span class="sgm-footer-dot"></span>
            Dikembangkan oleh <strong>Tim IT SGM Group</strong>
        </p>
        <p style="margin-top: 0.15rem; font-size: 0.58rem;">
            Sistem Inventaris Aset &bull; Powered by Laravel &amp; Filament
        </p>
    </footer>

</div>

</div>