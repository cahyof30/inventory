{{--
    mobile-card-footer.blade.php
    Di-inject via getFooter() di ListItems.
    Berisi:
      1. CSS untuk sembunyikan tabel di mobile & card di desktop
      2. <livewire:items.mobile-card-list> yang hanya tampil di mobile
--}}

<style>
    /* ── Sembunyikan TABEL di mobile ── */
    @media (max-width: 767px) {
        /* Wrapper tabel Filament */
        .fi-ta-ctn,
        .fi-ta-header,
        .fi-ta-footer {
            display: none !important;
        }
        /* Sembunyikan header actions (Import/Export/Scan) di mobile
           karena sudah ada di dalam card list */
        .fi-page-header {
            /* Biarkan header tetap muncul untuk tombol Create */
        }
    }

    /* ── Sembunyikan CARD LIST di desktop ── */
    @media (min-width: 768px) {
        .mobile-card-list-wrapper {
            display: none !important;
        }
    }
</style>

{{-- Card list: hanya render di mobile via CSS --}}
<div class="mobile-card-list-wrapper">
    <livewire:items.mobile-card-list :activeTab="$activeTab" />
</div>