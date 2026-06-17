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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

<script>
    console.log("Site Key:", "{{ config('services.recaptcha.site_key') }}");
console.log(grecaptcha);
const form = document.getElementById('searchForm');

form.addEventListener('submit', function (e) {

    e.preventDefault();

    console.log('Submit ditekan');

    grecaptcha.ready(function () {

        console.log('grecaptcha ready');

        grecaptcha.execute(
            "{{ config('services.recaptcha.site_key') }}",
            {
                action: 'search_item'
            }
        ).then(function (token) {

            console.log(token);

            document.getElementById('recaptchaToken').value = token;

            form.submit();

        });

    });

});

</script>