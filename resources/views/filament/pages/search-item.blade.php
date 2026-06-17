<x-filament-panels::page>

    <div x-data="recaptchaHandler($wire)" class="space-y-4">

        <x-filament::input.wrapper>

            <x-filament::input
                wire:model="code"
                placeholder="Masukkan kode barang"
            />

        </x-filament::input.wrapper>

        <x-filament::button
            type="button"
            x-on:click="executeRecaptcha()"
        >
            Cari
        </x-filament::button>

    </div>

    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

        <script>
            function recaptchaHandler($wire) {
                return {
                    executeRecaptcha() {
                        grecaptcha.ready(() => {
                            grecaptcha.execute(
                                "{{ config('services.recaptcha.site_key') }}",
                                { action: 'search_item' }
                            ).then(token => {
                                $wire.set('recaptchaToken', token);
                                $wire.search();
                            });
                        });
                    }
                }
            }
        </script>
    @endpush

</x-filament-panels::page>