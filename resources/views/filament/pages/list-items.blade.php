@php
    use Illuminate\Support\Facades\Storage;
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

<style>
    [x-cloak] { display: none !important; }
</style>

<x-filament-panels::page>

    {{-- ══════════════ DESKTOP: tabel Filament bawaan ══════════════ --}}
    <div x-data x-show="window.innerWidth >= 768" x-cloak>
        {{ $this->table }}
    </div>

    {{-- ══════════════ MOBILE: card list ══════════════ --}}
    <div x-data x-show="window.innerWidth < 768" x-cloak>

        {{-- Search Bar --}}
        <div class="relative mb-3">
            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                <x-filament::icon icon="heroicon-o-magnifying-glass" class="w-4 h-4 text-gray-400" />
            </div>
            <input
                type="search"
                wire:model.live.debounce.350ms="tableSearch"
                placeholder="Cari nama atau kode barang…"
                style="width:100%; border-radius:12px; border:1px solid #e5e7eb; padding:8px 12px 8px 36px; font-size:14px; outline:none;"
            />
        </div>

        {{-- Tab Pills --}}
        @if (method_exists($this, 'getTabs'))
            <div style="display:flex; gap:8px; overflow-x:auto; padding-bottom:4px; margin-bottom:12px;">
                @foreach ($this->getTabs() as $key => $tab)
                    <button
                        wire:click="$set('activeTab', '{{ $key }}')"
                        style="
                            display:inline-flex; align-items:center; gap:4px;
                            white-space:nowrap; border-radius:999px;
                            padding:5px 14px; font-size:12px; font-weight:600;
                            border: 1px solid {{ ($this->activeTab ?? 'all') === $key ? 'transparent' : '#e5e7eb' }};
                            background: {{ ($this->activeTab ?? 'all') === $key ? '#6366f1' : '#fff' }};
                            color: {{ ($this->activeTab ?? 'all') === $key ? '#fff' : '#6b7280' }};
                            cursor:pointer;
                        "
                    >
                        @if ($tab->getIcon())
                            <x-filament::icon :icon="$tab->getIcon()" style="width:14px;height:14px;" />
                        @endif
                        {{ $tab->getLabel() }}
                    </button>
                @endforeach
            </div>
        @endif

        {{-- Card List --}}
        @php $records = $this->getMobileRecords(15); @endphp

        @forelse ($records as $record)
            <div
                wire:key="mobile-card-{{ $record->id }}"
                style="
                    position:relative; overflow:hidden;
                    border-radius:16px;
                    background:#fff;
                    border:1px solid #f3f4f6;
                    box-shadow:0 1px 3px rgba(0,0,0,0.06);
                    margin-bottom:10px;
                "
            >
                {{-- Condition Badge --}}
                @if ($record->condition)
                    <div style="position:absolute; top:10px; right:10px; z-index:10;">
                        <span style="
                            display:inline-flex; align-items:center;
                            border-radius:999px; padding:2px 8px;
                            font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.04em;
                            background:{{ $record->condition === 'good' ? '#d1fae5' : '#fee2e2' }};
                            color:{{ $record->condition === 'good' ? '#065f46' : '#991b1b' }};
                        ">
                            {{ $record->condition === 'good' ? 'Baik' : 'Rusak' }}
                        </span>
                    </div>
                @endif

                {{-- Main Content --}}
                <div style="display:flex; gap:12px; padding:12px; padding-right:72px;">

                    {{-- Thumbnail / QR --}}
                    <div style="flex-shrink:0;">
                        @if ($record->image)
                            <div style="position:relative; width:60px; height:60px;">
                                <img
                                    src="{{ Storage::url($record->image) }}"
                                    alt="{{ $record->name }}"
                                    loading="lazy"
                                    style="width:60px; height:60px; border-radius:10px; object-fit:cover; border:1px solid #f3f4f6;"
                                />
                                @if ($record->qr_code)
                                    <div style="position:absolute; bottom:-4px; right:-4px; width:26px; height:26px; background:#fff; border-radius:6px; border:1px solid #e5e7eb; padding:2px;">
                                        {!! QrCode::size(20)->margin(0)->generate($record->qr_code) !!}
                                    </div>
                                @endif
                            </div>
                        @elseif ($record->qr_code)
                            <div style="width:60px; height:60px; display:flex; align-items:center; justify-content:center; background:#fff; border-radius:10px; border:1px solid #e5e7eb; padding:4px;">
                                {!! QrCode::size(50)->margin(0)->generate($record->qr_code) !!}
                            </div>
                        @else
                            <div style="width:60px; height:60px; display:flex; align-items:center; justify-content:center; background:#f9fafb; border-radius:10px; border:1px solid #f3f4f6;">
                                <x-filament::icon icon="heroicon-o-archive-box" style="width:28px;height:28px;color:#d1d5db;" />
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div style="flex:1; min-width:0;">
                        <p style="font-size:14px; font-weight:600; color:#111827; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-bottom:2px;">
                            {{ $record->name }}
                        </p>
                        @if ($record->code)
                            <p style="font-size:11px; font-family:monospace; color:#9ca3af; margin-bottom:6px;">
                                {{ $record->code }}
                            </p>
                        @endif

                        {{-- Chips --}}
                        <div style="display:flex; flex-wrap:wrap; gap:4px; margin-bottom:5px;">
                            @if ($record->vehicleDetail?->license_plate)
                                <span style="display:inline-flex;align-items:center;gap:3px;border-radius:999px;padding:2px 8px;font-size:10px;font-weight:600;background:#dbeafe;color:#1e40af;">
                                    <x-filament::icon icon="heroicon-o-truck" style="width:11px;height:11px;" />
                                    {{ $record->vehicleDetail->license_plate }}
                                </span>
                            @elseif ($record->category)
                                <span style="display:inline-flex;align-items:center;gap:3px;border-radius:999px;padding:2px 8px;font-size:10px;font-weight:600;background:#ede9fe;color:#5b21b6;">
                                    <x-filament::icon icon="heroicon-o-tag" style="width:11px;height:11px;" />
                                    {{ $record->category->name }}
                                </span>
                            @endif

                            @if ($record->brand)
                                <span style="display:inline-flex;align-items:center;border-radius:999px;padding:2px 8px;font-size:10px;font-weight:500;background:#f3f4f6;color:#6b7280;">
                                    {{ $record->brand }}
                                </span>
                            @endif

                            @if ($record->location)
                                <span style="display:inline-flex;align-items:center;gap:3px;border-radius:999px;padding:2px 8px;font-size:10px;font-weight:500;background:#fef3c7;color:#92400e;">
                                    <x-filament::icon icon="heroicon-o-map-pin" style="width:11px;height:11px;" />
                                    {{ $record->location->name }}
                                </span>
                            @endif
                        </div>

                        @if ($record->purchase_price)
                            <p style="font-size:13px; font-weight:700; color:#6366f1;">
                                Rp {{ number_format($record->purchase_price, 0, ',', '.') }}
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Action Row --}}
                <div style="display:flex; border-top:1px solid #f3f4f6;">
                    <button
                        wire:click="mountTableAction('detailItem', '{{ $record->id }}')"
                        style="flex:1;display:flex;align-items:center;justify-content:center;gap:4px;padding:10px 0;font-size:11px;font-weight:600;color:#6b7280;background:none;border:none;border-right:1px solid #f3f4f6;cursor:pointer;"
                    >
                        <x-filament::icon icon="heroicon-o-eye" style="width:14px;height:14px;" /> Detail
                    </button>
                    <button
                        wire:click="mountTableAction('view_qr', '{{ $record->id }}')"
                        style="flex:1;display:flex;align-items:center;justify-content:center;gap:4px;padding:10px 0;font-size:11px;font-weight:600;color:#10b981;background:none;border:none;border-right:1px solid #f3f4f6;cursor:pointer;"
                    >
                        <x-filament::icon icon="heroicon-o-qr-code" style="width:14px;height:14px;" /> QR
                    </button>
                    <a
                        href="{{ \App\Filament\Resources\Items\ItemResource::getUrl('edit', ['record' => $record]) }}"
                        style="flex:1;display:flex;align-items:center;justify-content:center;gap:4px;padding:10px 0;font-size:11px;font-weight:600;color:#3b82f6;text-decoration:none;border-right:1px solid #f3f4f6;"
                    >
                        <x-filament::icon icon="heroicon-o-pencil-square" style="width:14px;height:14px;" /> Edit
                    </a>
                    <button
                        wire:click="mountTableAction('delete', '{{ $record->id }}')"
                        wire:confirm="Yakin hapus '{{ addslashes($record->name) }}'?"
                        style="flex:1;display:flex;align-items:center;justify-content:center;gap:4px;padding:10px 0;font-size:11px;font-weight:600;color:#ef4444;background:none;border:none;cursor:pointer;"
                    >
                        <x-filament::icon icon="heroicon-o-trash" style="width:14px;height:14px;" /> Hapus
                    </button>
                </div>
            </div>
        @empty
            <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:60px 0;text-align:center;">
                <div style="width:72px;height:72px;border-radius:20px;background:#f9fafb;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                    <x-filament::icon icon="heroicon-o-archive-box" style="width:36px;height:36px;color:#d1d5db;" />
                </div>
                <p style="font-size:15px;font-weight:600;color:#374151;">Belum ada barang</p>
                <p style="font-size:13px;color:#9ca3af;margin-top:4px;">
                    @if ($this->tableSearch ?? null)
                        Tidak ada hasil untuk "{{ $this->tableSearch }}"
                    @else
                        Tekan + Tambah untuk mulai
                    @endif
                </p>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if ($records->hasPages())
            <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;margin-top:8px;">
                @if ($records->onFirstPage())
                    <span style="flex:1;border-radius:12px;border:1px solid #e5e7eb;padding:10px 0;text-align:center;font-size:13px;font-weight:500;color:#d1d5db;">← Sebelumnya</span>
                @else
                    <a href="{{ $records->previousPageUrl() }}" wire:navigate style="flex:1;border-radius:12px;border:1px solid #e5e7eb;padding:10px 0;text-align:center;font-size:13px;font-weight:600;color:#374151;text-decoration:none;">← Sebelumnya</a>
                @endif

                <span style="font-size:12px;color:#9ca3af;white-space:nowrap;">{{ $records->currentPage() }} / {{ $records->lastPage() }}</span>

                @if ($records->hasMorePages())
                    <a href="{{ $records->nextPageUrl() }}" wire:navigate style="flex:1;border-radius:12px;background:#6366f1;padding:10px 0;text-align:center;font-size:13px;font-weight:600;color:#fff;text-decoration:none;">Selanjutnya →</a>
                @else
                    <span style="flex:1;border-radius:12px;border:1px solid #e5e7eb;padding:10px 0;text-align:center;font-size:13px;font-weight:500;color:#d1d5db;">Selanjutnya →</span>
                @endif
            </div>
        @endif

    </div>

</x-filament-panels::page>
