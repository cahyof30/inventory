{{--
    filament/companies/mobile-footer.blade.php

    Strategi: gunakan Alpine + JS untuk menyembunyikan tabel Filament di mobile,
    karena selector CSS murni bergantung pada class internal Filament yang bisa berubah.
--}}
<style>
    .sgm-mobile-footer-wrap {
        display: none;
    }
</style>

<div class="sgm-mobile-footer-wrap" style="padding: 0 4px 80px;">
    @livewire('companies.mobile-company-card-list')
</div>

<script>
(function () {
    function applyLayout() {
        const isMobile = window.innerWidth < 768;
        const mobileWrap = document.querySelector('.sgm-mobile-footer-wrap');

        // Selector umum untuk tabel Filament — cakup semua kemungkinan wrapper-nya
        const tableSelectors = [
            '.fi-ta-wrp',         // Filament 5 table wrapper
            '.fi-ta',             // base table component
            '.fi-ta-header',      // toolbar/header tabel
            '.fi-ta-footer',      // footer tabel (pagination)
            '.fi-pagination',     // pagination
        ];

        // Cari elemen tabel: mulai dari dalam .fi-page-content
        const pageContent = document.querySelector('.fi-page-content');
        const tableEls = [];

        if (pageContent) {
            tableSelectors.forEach(sel => {
                pageContent.querySelectorAll(sel).forEach(el => tableEls.push(el));
            });

            // Fallback: sembunyikan semua direct children kecuali sgm-mobile-footer-wrap
            if (tableEls.length === 0 && isMobile) {
                Array.from(pageContent.children).forEach(child => {
                    if (!child.classList.contains('sgm-mobile-footer-wrap')) {
                        tableEls.push(child);
                    }
                });
            }
        }

        if (isMobile) {
            tableEls.forEach(el => el.style.setProperty('display', 'none', 'important'));
            if (mobileWrap) mobileWrap.style.display = 'block';
        } else {
            tableEls.forEach(el => el.style.removeProperty('display'));
            if (mobileWrap) mobileWrap.style.display = 'none';
        }
    }

    // Jalankan setelah DOM siap
    document.addEventListener('DOMContentLoaded', applyLayout);

    // Jalankan ulang saat Livewire navigasi (SPA mode)
    document.addEventListener('livewire:navigated', applyLayout);

    // Responsive: jalankan saat resize
    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(applyLayout, 100);
    });

    // Safety: jalankan segera juga (jika DOMContentLoaded sudah lewat)
    if (document.readyState !== 'loading') {
        applyLayout();
    }
})();
</script>