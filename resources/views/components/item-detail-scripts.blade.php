 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    const allowedHost =
    window.location.hostname;

    
    function isValidQrUrl(url) {

    try {

        const parsed = new URL(url);

        return parsed.hostname === allowedHost;

    } catch {

        return false;
    }

}
    </script>
   

    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('recaptchaSearch', (livewire) => ({
        submit() {

            if (!window.grecaptcha) {
                console.error('reCAPTCHA not loaded');
                return;
            }

            grecaptcha.ready(() => {

                grecaptcha.execute(
                    "{{ config('services.recaptcha.site_key') }}",
                    { action: 'search_item' }
                ).then((token) => {

                    // kirim ke Livewire dengan cara aman
                    livewire.set('recaptchaToken', token)

                    livewire.call('search')

                });

            });

        }
    }));
});
</script>