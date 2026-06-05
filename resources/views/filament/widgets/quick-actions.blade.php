<x-filament::section>
    <div class="flex flex-col items-center gap-4">

        <a
            href="{{ route('asset.scan') }}"
            class="w-full max-w-md"
        >
            <x-filament::button
                icon="heroicon-o-qr-code"
                size="xl"
                class="w-full !justify-center py-5"
            >
                Scan QR Asset
            </x-filament::button>
        </a>

        <a
            href="{{ route('filament.admin.resources.items.create') }}"
            class="w-full max-w-md"
        >
            <x-filament::button
                icon="heroicon-o-plus"
                color="primary"
                size="xl"
                class="w-full !justify-center py-5"
            >
                Tambah Asset
            </x-filament::button>
        </a>

        <a
            href="{{ route('filament.admin.resources.items.index') }}"
            class="w-full max-w-md"
        >
            <x-filament::button
                icon="heroicon-o-cube"
                color="gray"
                size="xl"
                class="w-full !justify-center py-5"
            >
                Daftar Asset
            </x-filament::button>
        </a>

    </div>
</x-filament::section>