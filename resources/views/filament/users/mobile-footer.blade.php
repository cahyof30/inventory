{{--
    filament/users/mobile-footer.blade.php
    Di mobile (< 768px): sembunyikan tabel Filament, tampilkan kartu mobile.
    Di desktop: kartu mobile disembunyikan.
--}}
<style>
    .sgm-mobile-users-wrap {
        display: none;
    }
</style>

<div class="sgm-mobile-users-wrap" style="padding: 0 4px 80px;">
    @livewire('users.mobile-user-card-list')
</div>

<script>
(function () {
    function applyLayout() {
        const isMobile = window.innerWidth < 768;
        const mobileWrap = document.querySelector('.sgm-mobile-users-wrap');

        const tableSelectors = [
            '.fi-ta-wrp',
            '.fi-ta',
            '.fi-ta-header',
            '.fi-ta-footer',
            '.fi-pagination',
        ];

        const pageContent = document.querySelector('.fi-page-content');
        const tableEls = [];

        if (pageContent) {
            tableSelectors.forEach(sel => {
                pageContent.querySelectorAll(sel).forEach(el => tableEls.push(el));
            });

            // Fallback: sembunyikan semua direct children kecuali wrapper kita
            if (tableEls.length === 0 && isMobile) {
                Array.from(pageContent.children).forEach(child => {
                    if (!child.classList.contains('sgm-mobile-users-wrap')) {
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

    document.addEventListener('DOMContentLoaded', applyLayout);
    document.addEventListener('livewire:navigated', applyLayout);

    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(applyLayout, 100);
    });

    if (document.readyState !== 'loading') {
        applyLayout();
    }
})();
</script>