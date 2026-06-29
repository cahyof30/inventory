<x-filament-panels::page>

@php
    $items = $this->getItems();
@endphp

<style>
    .sgm-desktop-view { display: block; }
    .sgm-mobile-view  { display: none;  }

    @media (max-width: 767px) {
        .sgm-desktop-view { display: none !important; }
        .sgm-mobile-view  { display: block !important; }
    }

    .sgm-table-wrap {
        background: #FFFBF3;
        border-radius: 18px;
        border: 1.5px solid rgba(245,168,0,0.25);
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(26,10,0,0.06);
    }
    .sgm-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
    .sgm-table thead tr {
        background: linear-gradient(135deg, rgba(245,168,0,0.12), rgba(217,79,0,0.07));
        border-bottom: 1.5px solid rgba(245,168,0,0.25);
    }
    .sgm-table thead th {
        padding: 13px 16px; text-align: left;
        font-size: 10px; font-weight: 700;
        letter-spacing: 0.1em; text-transform: uppercase;
        color: #8B5E3C; white-space: nowrap;
    }
    .sgm-table tbody tr { border-bottom: 1px solid rgba(245,168,0,0.1); transition: background 0.15s; }
    .sgm-table tbody tr:last-child { border-bottom: none; }
    .sgm-table tbody tr:hover { background: rgba(245,168,0,0.04); }
    .sgm-table td { padding: 13px 16px; color: #3D1C02; vertical-align: middle; }

    .sgm-search-wrap { position: relative; margin-bottom: 16px; }
    .sgm-search-icon {
        position: absolute; left: 13px; top: 50%;
        transform: translateY(-50%); pointer-events: none; color: #9ca3af;
    }
    .sgm-search-input {
        width: 100%; border-radius: 12px;
        border: 1.5px solid rgba(245,168,0,0.3);
        background: #fff; padding: 10px 14px 10px 40px;
        font-size: 14px; color: #111827; outline: none;
        box-sizing: border-box; box-shadow: 0 1px 4px rgba(245,168,0,0.08);
    }
    .sgm-search-input:focus { border-color: #F5A800; box-shadow: 0 0 0 3px rgba(245,168,0,0.12); }

    .sgm-pill {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 10px; border-radius: 99px;
        font-size: 10px; font-weight: 700;
        letter-spacing: 0.06em; text-transform: uppercase; white-space: nowrap;
    }
    .sgm-pill-gold { background: rgba(245,168,0,0.13); color: #D48900; border: 1px solid rgba(245,168,0,0.28); }
    .sgm-pill-ember { background: rgba(217,79,0,0.1); color: #D94F00; border: 1px solid rgba(217,79,0,0.22); }

    .sgm-sort-btn {
        background: none; border: none; cursor: pointer;
        font-size: 10px; font-weight: 700; letter-spacing: 0.1em;
        text-transform: uppercase; color: #8B5E3C;
        display: inline-flex; align-items: center; gap: 4px; padding: 0;
    }
    .sgm-sort-btn:hover { color: #D48900; }

    .sgm-pagination {
        display: flex; align-items: center; justify-content: space-between;
        gap: 8px; padding: 14px 16px;
        border-top: 1px solid rgba(245,168,0,0.15);
        background: rgba(245,168,0,0.03);
    }
    .sgm-page-link {
        display: inline-block;
        border-radius: 10px; border: 1.5px solid rgba(245,168,0,0.3);
        background: #fff; padding: 7px 16px;
        font-size: 12px; font-weight: 600; color: #3D1C02;
        text-decoration: none; transition: all 0.15s;
    }
    .sgm-page-link:hover { background: rgba(245,168,0,0.08); }
    .sgm-page-link.disabled {
        opacity: 0.35; pointer-events: none; cursor: not-allowed;
    }
    .sgm-page-link.next {
        background: linear-gradient(135deg,#F5A800,#D94F00);
        color: #fff; border-color: transparent;
        box-shadow: 0 3px 10px rgba(217,79,0,0.25);
    }
</style>

{{-- TOOLBAR --}}
<div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin-bottom:16px;">
    <div class="sgm-search-wrap" style="flex:1; min-width:220px; margin-bottom:0;">
        <span class="sgm-search-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
        </span>
        <input
            wire:model.live.debounce.350ms="search"
            type="search"
            placeholder="Cari nama barang, brand, kode, atau PIC…"
            class="sgm-search-input"
        />
    </div>

    <div style="display:flex; gap:6px; flex-shrink:0;">
        @foreach (['name' => 'Nama', 'brand' => 'Brand', 'location' => 'Lokasi'] as $key => $label)
            <button
                wire:click="$set('sortBy', '{{ $key }}')"
                style="
                    padding: 8px 14px; border-radius: 10px;
                    font-size: 11px; font-weight: 700; letter-spacing: 0.05em;
                    border: 1.5px solid {{ $sortBy === $key ? 'transparent' : 'rgba(245,168,0,0.3)' }};
                    background: {{ $sortBy === $key ? 'linear-gradient(135deg,#F5A800,#D94F00)' : '#fff' }};
                    color: {{ $sortBy === $key ? '#fff' : '#8B5E3C' }};
                    cursor: pointer;
                    box-shadow: {{ $sortBy === $key ? '0 3px 10px rgba(217,79,0,0.25)' : 'none' }};
                "
            >{{ $label }}</button>
        @endforeach
    </div>
</div>

{{-- Summary --}}
<div style="
    display:inline-flex; align-items:center; gap:6px;
    background:rgba(245,168,0,0.09); border:1px solid rgba(245,168,0,0.22);
    border-radius:10px; padding:6px 14px; margin-bottom:16px;
    font-size:12px; font-weight:600; color:#8B5E3C;
">
    📦 {{ $items->total() }} barang sedang dipinjam
    @if($search) · hasil untuk "<strong>{{ $search }}</strong>" @endif
</div>

{{-- ══════════════ DESKTOP TABLE ══════════════ --}}
<div class="sgm-desktop-view">
    <div class="sgm-table-wrap">
        <table class="sgm-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><button class="sgm-sort-btn" wire:click="$set('sortBy','name')">Nama Barang @if($sortBy==='name')<span style="color:#F5A800;">↑</span>@endif</button></th>
                    <th><button class="sgm-sort-btn" wire:click="$set('sortBy','brand')">Seri
                         {{-- @if($sortBy==='brand')<span style="color:#F5A800;">↑</span>@endif --}}
                        </button>
                        </th>
                    <th>Kode Aset</th>
                    <th><button class="sgm-sort-btn" wire:click="$set('sortBy','location')">Lokasi @if($sortBy==='location')<span style="color:#F5A800;">↑</span>@endif</button></th>
                    <th>PIC (Peminjam)</th>
                    {{-- <th>Email PIC</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $i => $item)
                    <tr>
                        <td style="color:#9ca3af;font-size:12px;width:40px;">{{ $items->firstItem() + $i }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                @if ($item->image)
                                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}"
                                        style="width:36px;height:36px;object-fit:cover;border-radius:8px;border:1px solid rgba(245,168,0,0.25);"/>
                                @else
                                    <div style="width:36px;height:36px;border-radius:8px;background:linear-gradient(135deg,rgba(245,168,0,0.15),rgba(217,79,0,0.1));border:1px solid rgba(245,168,0,0.25);display:flex;align-items:center;justify-content:center;font-size:14px;">📦</div>
                                @endif
                                <span style="font-weight:600;color:#3D1C02;">{{ $item->name }} {{ $item->brand }}</span>
                            </div>
                        </td>
                        <td><span class="sgm-pill sgm-pill-gold">{{ $item->specification['seri'] ?? '—' }}</span></td>
                        <td><span style="font-family:monospace;font-size:12px;color:#8B5E3C;">{{ $item->code ?? '—' }}</span></td>
                        <td><span class="sgm-pill sgm-pill-ember">📍 {{ $item->location?->name ?? '—' }}</span></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#F5A800,#D94F00);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#fff;flex-shrink:0;">
                                    {{ strtoupper(substr($item->pic?->name ?? '?', 0, 1)) }}
                                </div>
                                <span style="font-weight:600;color:#3D1C02;">{{ $item->pic?->name ?? '—' }}</span>
                            </div>
                        </td>
                        {{-- <td style="color:#8B5E3C;font-size:12px;">{{ $item->pic?->email ?? '—' }}</td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:48px;color:#9ca3af;">
                            <div style="font-size:36px;margin-bottom:8px;">📭</div>
                            <div style="font-weight:600;">Tidak ada barang yang sedang dipinjam</div>
                            @if($search)<div style="font-size:12px;margin-top:4px;">Coba kata kunci lain</div>@endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($items->hasPages())
            <div class="sgm-pagination">
                <span style="font-size:12px;color:#8B5E3C;">
                    {{ $items->firstItem() }}–{{ $items->lastItem() }} dari {{ $items->total() }} barang
                </span>
                <div style="display:flex;gap:6px;align-items:center;">
                    @if ($items->onFirstPage())
                        <span class="sgm-page-link disabled">← Prev</span>
                    @else
                        <button wire:click="goToPage({{ $items->currentPage() - 1 }})" class="sgm-page-link" style="cursor:pointer;">← Prev</button>
                    @endif

                    <span style="font-size:12px;color:#8B5E3C;padding:0 4px;">
                        {{ $items->currentPage() }} / {{ $items->lastPage() }}
                    </span>

                    @if ($items->hasMorePages())
                        <button wire:click="goToPage({{ $items->currentPage() + 1 }})" class="sgm-page-link next" style="cursor:pointer;">Next →</button>
                    @else
                        <span class="sgm-page-link next disabled">Next →</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>


{{-- ══════════════ MOBILE CARDS ══════════════ --}}
<div class="sgm-mobile-view" style="padding-bottom:80px;">
    @forelse ($items as $item)
        <div wire:key="loan-card-{{ $item->id }}" style="border-radius:18px;background:#FFFBF3;border:1.5px solid rgba(245,168,0,0.2);box-shadow:0 2px 8px rgba(26,10,0,0.06);margin-bottom:10px;overflow:hidden;">

            {{-- Header --}}
            <div style="display:flex;align-items:center;gap:13px;padding:14px 14px 12px;background:linear-gradient(135deg,rgba(245,168,0,0.07),rgba(217,79,0,0.04));border-bottom:1px solid rgba(245,168,0,0.13);">
                @if ($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}"
                        style="width:54px;height:54px;object-fit:cover;border-radius:12px;border:1.5px solid rgba(245,168,0,0.28);flex-shrink:0;"/>
                @else
                    <div style="width:54px;height:54px;border-radius:12px;flex-shrink:0;background:linear-gradient(135deg,rgba(245,168,0,0.13),rgba(217,79,0,0.08));border:1.5px solid rgba(245,168,0,0.25);display:flex;align-items:center;justify-content:center;font-size:22px;">📦</div>
                @endif
                <div style="flex:1;min-width:0;">
                    <p style="font-size:14px;font-weight:700;color:#3D1C02;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;margin-bottom:3px;">{{ $item->name }} {{ $item->brand ?? '' }} {{ $item->specification['seri'] ?? '' }}</p>
                    <span style="font-family:monospace;font-size:11px;color:#8B5E3C;opacity:0.8;">{{ $item->code ?? '—' }}</span>
                </div>
            </div>

            {{-- Detail --}}
            <div style="padding:12px 14px;display:grid;gap:7px;">
                <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;">
                    <span style="font-size:11px;color:#8B5E3C;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Brand</span>
                    <span class="sgm-pill sgm-pill-gold">{{ $item->brand ?? '—' }}</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;">
                    <span style="font-size:11px;color:#8B5E3C;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Lokasi</span>
                    <span class="sgm-pill sgm-pill-ember">📍 {{ $item->location?->name ?? '—' }}</span>
                </div>
            </div>

            {{-- PIC --}}
            <div style="margin:0 14px 14px;background:#fff;border-radius:12px;border:1.5px solid rgba(245,168,0,0.22);padding:11px 13px;display:flex;align-items:center;gap:11px;">
                <div style="width:38px;height:38px;border-radius:50%;flex-shrink:0;background:linear-gradient(135deg,#F5A800,#D94F00);display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:700;color:#fff;box-shadow:0 3px 10px rgba(217,79,0,0.25);">
                    {{ strtoupper(substr($item->pic?->name ?? '?', 0, 1)) }}
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:10px;color:#8B5E3C;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;margin-bottom:2px;">PIC / Peminjam</div>
                    <div style="font-size:13px;font-weight:700;color:#3D1C02;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $item->pic?->name ?? '—' }}</div>
                    {{-- <div style="font-size:11px;color:#8B5E3C;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;margin-top:1px;">{{ $item->pic?->email ?? '' }}</div> --}}
                </div>
                @if ($item->pic?->gender)
                    <div style="width:24px;height:24px;border-radius:50%;flex-shrink:0;background:{{ $item->pic->gender === 'M' ? '#3B82F6' : '#EC4899' }};display:flex;align-items:center;justify-content:center;font-size:11px;color:#fff;font-weight:900;">
                        {{ $item->pic->gender === 'M' ? '♂' : '♀' }}
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div style="text-align:center;padding:48px 0;">
            <div style="font-size:48px;margin-bottom:12px;">📭</div>
            <p style="font-size:15px;font-weight:600;color:#374151;">Tidak ada barang dipinjam</p>
            <p style="font-size:13px;color:#9ca3af;margin-top:4px;">
                @if($search) Tidak ada hasil untuk "{{ $search }}" @else Semua barang sedang tersedia @endif
            </p>
        </div>
    @endforelse

    {{-- Pagination mobile --}}
    @if ($items->hasPages())
        <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-top:12px;">
            @if ($items->onFirstPage())
                <span style="flex:1;border-radius:12px;border:1px solid #e5e7eb;padding:10px 0;text-align:center;font-size:13px;font-weight:500;color:#d1d5db;">← Prev</span>
            @else
                <button wire:click="goToPage({{ $items->currentPage() - 1 }})" style="flex:1;border-radius:12px;border:1px solid #e5e7eb;background:#fff;padding:10px 0;text-align:center;font-size:13px;font-weight:600;color:#374151;cursor:pointer;">← Prev</button>
            @endif

            <span style="font-size:12px;color:#9ca3af;white-space:nowrap;">{{ $items->currentPage() }} / {{ $items->lastPage() }}</span>

            @if ($items->hasMorePages())
                <button wire:click="goToPage({{ $items->currentPage() + 1 }})" style="flex:1;border-radius:12px;background:linear-gradient(135deg,#F5A800,#D94F00);border:none;padding:10px 0;text-align:center;font-size:13px;font-weight:600;color:#fff;cursor:pointer;">Next →</button>
            @else
                <span style="flex:1;border-radius:12px;border:1px solid #e5e7eb;padding:10px 0;text-align:center;font-size:13px;font-weight:500;color:#d1d5db;">Next →</span>
            @endif
        </div>
    @endif
</div>

</x-filament-panels::page>