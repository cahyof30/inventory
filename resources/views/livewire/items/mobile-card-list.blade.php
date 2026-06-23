@php
    use Illuminate\Support\Facades\Storage;
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
    use App\Filament\Resources\Items\ItemResource;
@endphp

<div
    x-data="{
        openQr: false,
        qr: '',
        name: '',
    }"
>
    {{-- Search --}}
    <div style="position:relative; margin-bottom:12px;">
        <div style="position:absolute; left:12px; top:50%; transform:translateY(-50%); pointer-events:none;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;color:#9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
        </div>
        <input
            type="search"
            wire:model.live.debounce.350ms="search"
            placeholder="Cari nama atau kode barang…"
            style="width:100%; border-radius:12px; border:1px solid #e5e7eb; background:#fff; padding:9px 14px 9px 38px; font-size:14px; color:#111827; outline:none; box-sizing:border-box;"
        />
    </div>

    {{-- Tab pills --}}
    <div style="display:flex; gap:6px; overflow-x:auto; padding-bottom:4px; margin-bottom:14px; -webkit-overflow-scrolling:touch;">
        @foreach ([
            'all'       => ['label' => 'Semua',    'icon' => null],
            'kendaraan' => ['label' => 'Kendaraan','icon' => '🚛'],
            'peralatan' => ['label' => 'Peralatan','icon' => '🖥️'],
        ] as $key => $item)
            <button
                wire:click="$set('activeTab', '{{ $key }}')"
                style="
                    display:inline-flex; align-items:center; gap:5px;
                    white-space:nowrap; border-radius:999px;
                    padding:6px 14px; font-size:12px; font-weight:600;
                    border: 1px solid {{ $activeTab === $key ? 'transparent' : '#e5e7eb' }};
                    background: {{ $activeTab === $key ? '#f59e0b' : '#fff' }};
                    color: {{ $activeTab === $key ? '#fff' : '#6b7280' }};
                    cursor:pointer; transition: all 0.15s;
                "
            >
                @if ($item['icon']) {{ $item['icon'] }} @endif
                {{ $item['label'] }}
            </button>
        @endforeach
    </div>

    {{-- Cards --}}
    @forelse ($records as $record)
        <div
            wire:key="card-{{ $record->id }}"
            style="
                position:relative; overflow:hidden;
                border-radius:16px; background:#fff;
                border:1px solid #f3f4f6;
                box-shadow:0 1px 4px rgba(0,0,0,0.06);
                margin-bottom:10px;
            "
        >
            {{-- Badge kondisi --}}
            @if ($record->condition)
                <div style="position:absolute; top:10px; right:10px; z-index:5;">
                    <span style="
                        border-radius:999px; padding:2px 8px;
                        font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.04em;
                        background:{{ $record->condition === 'good' ? '#d1fae5' : '#fee2e2' }};
                        color:{{ $record->condition === 'good' ? '#065f46' : '#991b1b' }};
                    ">
                        {{ $record->condition === 'good' ? 'Baik' : 'Rusak' }}
                    </span>
                </div>
            @endif

            {{-- Body --}}
            <div style="display:flex; gap:12px; padding:12px; padding-right:70px;">

                {{-- Thumbnail / QR --}}
                <div style="flex-shrink:0;">
                    @if ($record->image)
                        <div style="position:relative; width:60px; height:60px;">
                            <img
                                src="{{ Storage::url($record->image) }}"
                                alt="{{ $record->name }}"
                                loading="lazy"
                                style="width:60px;height:60px;border-radius:10px;object-fit:cover;border:1px solid #f3f4f6;"
                            />
                            @if ($record->qr_code)
                                <div style="position:absolute;bottom:-3px;right:-3px;width:22px;height:22px;background:#fff;border-radius:5px;border:1px solid #e5e7eb;padding:2px;">
                                    {!! QrCode::size(16)->margin(0)->generate($record->qr_code) !!}
                                </div>
                            @endif
                        </div>
                    @elseif ($record->qr_code)
                        <div style="width:60px;height:60px;display:flex;align-items:center;justify-content:center;background:#fafafa;border-radius:10px;border:1px solid #e5e7eb;padding:4px;">
                            {!! QrCode::size(50)->margin(0)->generate($record->qr_code) !!}
                        </div>
                    @else
                        <div style="width:60px;height:60px;display:flex;align-items:center;justify-content:center;background:#f9fafb;border-radius:10px;border:1px solid #f3f4f6;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:28px;height:28px;color:#d1d5db;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7H4a2 2 0 00-2 2v8a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div style="flex:1;min-width:0;">
                    <p style="font-size:14px;font-weight:600;color:#111827;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;margin-bottom:2px;">
                        {{ $record->name }}
                    </p>
                    @if ($record->code)
                        <p style="font-size:11px;font-family:monospace;color:#9ca3af;margin-bottom:6px;">
                            {{ $record->code }}
                        </p>
                    @endif

                    {{-- Chips --}}
                    <div style="display:flex;flex-wrap:wrap;gap:4px;margin-bottom:5px;">
                        @if ($record->vehicleDetail?->license_plate)
                            <span style="display:inline-flex;align-items:center;gap:3px;border-radius:999px;padding:2px 8px;font-size:10px;font-weight:600;background:#dbeafe;color:#1e40af;">
                                🚛 {{ $record->vehicleDetail->license_plate }}
                            </span>
                        @elseif ($record->category)
                            <span style="display:inline-flex;align-items:center;gap:3px;border-radius:999px;padding:2px 8px;font-size:10px;font-weight:600;background:#ede9fe;color:#5b21b6;">
                                🏷 {{ $record->category->name }}
                            </span>
                        @endif

                        @if ($record->brand)
                            <span style="border-radius:999px;padding:2px 8px;font-size:10px;font-weight:500;background:#f3f4f6;color:#6b7280;">
                                {{ $record->brand }}
                            </span>
                        @endif

                        @if ($record->location)
                            <span style="display:inline-flex;align-items:center;gap:3px;border-radius:999px;padding:2px 8px;font-size:10px;font-weight:500;background:#fef3c7;color:#92400e;">
                                📍 {{ $record->location->name }}
                            </span>
                        @endif
                    </div>

                    @if ($record->purchase_price)
                        <p style="font-size:13px;font-weight:700;color:#f59e0b;">
                            Rp {{ number_format($record->purchase_price, 0, ',', '.') }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- Action row --}}
            <div style="display:flex;border-top:1px solid #f3f4f6;">

                {{-- Detail: link ke halaman edit sebagai fallback karena modal Filament
                     tidak bisa dipanggil dari Livewire component terpisah --}}
                <a
                    href="{{ ItemResource::getUrl('edit', ['record' => $record]) }}"
                    style="flex:1;display:flex;align-items:center;justify-content:center;gap:4px;padding:11px 0;font-size:11px;font-weight:600;color:#6b7280;text-decoration:none;border-right:1px solid #f3f4f6;">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
	<path d="M0 0h24v24H0z" fill="none" />
	<g fill="none">
		<path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
		<path fill="currentColor" d="M13 3a1 1 0 0 1 .117 1.993L13 5H5v14h14v-8a1 1 0 0 1 1.993-.117L21 11v8a2 2 0 0 1-1.85 1.995L19 21H5a2 2 0 0 1-1.995-1.85L3 19V5a2 2 0 0 1 1.85-1.995L5 3zm6.243.343a1 1 0 0 1 1.497 1.32l-.083.095l-9.9 9.899a1 1 0 0 1-1.497-1.32l.083-.094z" />
	</g>
</svg>
                    Edit
                </a>

                {{-- QR: buka halaman QR tersendiri atau modal --}}
              <button
    type="button"
    @click="
        qr = @js($record->qr_code);
        name = @js($record->name);
        openQr = true;
    "
    style="flex:1;display:flex;align-items:center;justify-content:center;gap:4px;padding:11px 0;font-size:11px;font-weight:600;color:#10b981;background:none;border:none;cursor:pointer;border-right:1px solid #f3f4f6;"
>
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
	<path d="M0 0h24v24H0z" fill="none" />
	<path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1zm3 12v.01M14 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zM7 7v.01M4 15a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1zm13-8v.01M14 14h3m3 0v.01M14 14v3m0 3h3m0-3h3m0 0v3" />
</svg>
                    QR
</button>

                {{-- Detail: link ke halaman edit sebagai fallback karena modal Filament
                     tidak bisa dipanggil dari Livewire component terpisah --}}

                <a
                    href="{{ ItemResource::getUrl('edit', ['record' => $record]) }}"
                    style="flex:1;display:flex;align-items:center;justify-content:center;gap:4px;padding:11px 0;font-size:11px;font-weight:600;color:#6b7280;text-decoration:none;border-right:1px solid #f3f4f6;">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Detail
                </a>
                {{-- Hapus --}}
                <button
                    wire:click="deleteRecord({{ $record->id }})"
                    wire:confirm="Yakin hapus '{{ addslashes($record->name) }}'?"
                    style="flex:1;display:flex;align-items:center;justify-content:center;gap:4px;padding:11px 0;font-size:11px;font-weight:600;color:#ef4444;background:none;border:none;cursor:pointer;"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </div>
        </div>
    @empty
        <div style="text-align:center;padding:48px 0;">
            <div style="font-size:48px;margin-bottom:12px;">📦</div>
            <p style="font-size:15px;font-weight:600;color:#374151;">Belum ada barang</p>
            <p style="font-size:13px;color:#9ca3af;margin-top:4px;">
                @if ($search)
                    Tidak ada hasil untuk "{{ $search }}"
                @else
                    Tekan + Tambah untuk mulai
                @endif
            </p>
        </div>
    @endforelse
    

    {{-- Pagination --}}
    @if ($records->hasPages())
        <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-top:12px;margin-bottom:4px;">
            @if ($records->onFirstPage())
                <span style="flex:1;border-radius:12px;border:1px solid #e5e7eb;padding:10px 0;text-align:center;font-size:13px;font-weight:500;color:#d1d5db;">← Prev</span>
            @else
                <button wire:click="previousPage('card_page')" style="flex:1;border-radius:12px;border:1px solid #e5e7eb;background:#fff;padding:10px 0;text-align:center;font-size:13px;font-weight:600;color:#374151;cursor:pointer;">← Prev</button>
            @endif

            <span style="font-size:12px;color:#9ca3af;white-space:nowrap;">{{ $records->currentPage() }} / {{ $records->lastPage() }}</span>

            @if ($records->hasMorePages())
                <button wire:click="nextPage('card_page')" style="flex:1;border-radius:12px;background:#f59e0b;border:none;padding:10px 0;text-align:center;font-size:13px;font-weight:600;color:#fff;cursor:pointer;">Next →</button>
            @else
                <span style="flex:1;border-radius:12px;border:1px solid #e5e7eb;padding:10px 0;text-align:center;font-size:13px;font-weight:500;color:#d1d5db;">Next →</span>
            @endif
        </div>
    @endif

    {{-- @if ($showQrModal)
    <div
        style="
            position:fixed;
            inset:0;
            background:rgba(0,0,0,.5);
            display:flex;
            align-items:center;
            justify-content:center;
            z-index:9999;
        "
        wire:click="closeQr"
    >

        <div
            wire:click.stop
            style="
                width:320px;
                background:#fff;
                border-radius:16px;
                padding:24px;
                text-align:center;
            "
        >
            <h3 style="font-size:18px;font-weight:600;margin-bottom:16px;">
                {{ $selectedItemName }}
            </h3>

            <div style="display:flex;justify-content:center;">
                {!! QrCode::size(220)->margin(1)->generate($selectedQrCode) !!}
            </div>

            <p style="margin-top:15px;font-size:12px;color:#6b7280;">
                {{ $selectedQrCode }}
            </p>

            <button
                wire:click="closeQr"
                style="
                    margin-top:20px;
                    width:100%;
                    padding:10px;
                    border:none;
                    border-radius:10px;
                    background:#10b981;
                    color:white;
                    font-weight:600;
                    cursor:pointer;
                "
            >
                Tutup
            </button>
        </div>

    </div>
@endif --}}


<template x-if="openQr">
    <div
        x-cloak
        x-transition.opacity
        style="
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        "
        @click="openQr = false"
    >
        <div
            @click.stop
            style="
                width: 320px;
                background: #fff;
                border-radius: 16px;
                padding: 24px;
                text-align: center;
            "
        >
            <h3
                x-text="name"
                style="font-size: 18px; font-weight: 600; margin-bottom: 18px;"
            ></h3>

            <div style="display: flex; justify-content: center;">
                {!! QrCode::size(220)->margin(1)->generate($record->qr_code) !!}
            </div>

            <p
                x-text="qr"
                style="margin-top: 16px; font-size: 12px; color: #6b7280; word-break: break-all;"
            ></p>

            <button
                @click="openQr = false"
                style="
                    margin-top: 20px;
                    width: 100%;
                    border: none;
                    border-radius: 10px;
                    padding: 10px;
                    background: #10b981;
                    color: white;
                    cursor: pointer;
                    font-weight: 600;
                "
            >
                Tutup
            </button>
        </div>
    </div>
</template>
</div>