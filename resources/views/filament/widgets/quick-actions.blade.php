<x-filament-widgets::widget>
    <x-filament::section>

        <div class="grid gap-4 md:grid-cols-3">

            <a
                href="{{ route('items.scan-camera') }}"
                class="fi-btn fi-btn-color-primary"
            >
                📷 Scan QR Asset
            </a>

            <a
                href="{{ route('filament.admin.resources.items.create') }}"
                class="fi-btn fi-btn-color-gray"
            >
                ➕ Tambah Aset
            </a>

            <a
                href="{{ route('filament.admin.resources.items.index') }}"
                class="fi-btn fi-btn-color-gray"
            >
                📦 Daftar Aset
            </a>

        </div>

    </x-filament::section>
</x-filament-widgets::widget>