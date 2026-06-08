<x-filament-panels::page>

    <div class="flex justify-center">

        <div class="w-full max-w-3xl">

            <x-filament::section>

                <div class="flex justify-center mb-6">

                    @if($item->company?->logo)
                        <img
                            src="{{ asset('storage/'.$item->company->logo) }}"
                            alt="Logo"
                            class="h-40"
                        >
                    @endif

                </div>

                <div class="text-center mb-8">

                    <h1 class="text-2xl font-bold">
                        Informasi Aset SGM Group
                    </h1>

                </div>

                <table class="w-full">

                    <tr>
                        <td class="py-2 font-medium w-48">
                            Kode Barang
                        </td>
                        <td>{{ $item->code }}</td>
                    </tr>

                    <tr>
                        <td class="py-2 font-medium">
                            Nama Barang
                        </td>
                        <td>{{ $item->name }}</td>
                    </tr>

                    <tr>
                        <td class="py-2 font-medium">
                            Perusahaan
                        </td>
                        <td>
                            {{ $item->company?->company_name }}
                        </td>
                    </tr>

                    <tr>
                        <td class="py-2 font-medium">
                            Lokasi
                        </td>
                        <td>
                            {{ $item->location?->name }}
                        </td>
                    </tr>

                    <tr>
                        <td class="py-2 font-medium">
                            Status
                        </td>
                        <td>

                            <x-filament::badge
                                color="success"
                            >
                                Verified
                            </x-filament::badge>

                        </td>
                    </tr>

                </table>

                <div class="mt-8">

                    <x-filament::button
                        tag="a"
                        :href="route('filament.admin.pages.scan-qr')"
                        icon="heroicon-o-qr-code"
                        class="w-full"
                    >
                        Scan QR Lain
                    </x-filament::button>

                </div>

            </x-filament::section>

        </div>

    </div>

</x-filament-panels::page>