@php
    use App\Filament\Resources\Users\UserResource;
@endphp

<div>
    {{-- Search --}}
    <div style="position:relative; margin-bottom:14px;">
        <div style="position:absolute; left:12px; top:50%; transform:translateY(-50%); pointer-events:none;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;color:#9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
        </div>
        <input
            type="search"
            wire:model.live.debounce.350ms="search"
            placeholder="Cari nama atau email pengguna…"
            style="width:100%; border-radius:12px; border:1px solid #e5e7eb; background:#fff; padding:9px 14px 9px 38px; font-size:14px; color:#111827; outline:none; box-sizing:border-box;"
        />
    </div>

    {{-- Cards --}}
    @forelse ($records as $record)
        @php
            $isMale    = $record->gender === 'M';
            $isFemale  = $record->gender === 'F';
            $isGA      = $record->role === 'ga';

            // Warna aksen per gender
            $avatarBg     = $isMale   ? 'linear-gradient(135deg,#BFDBFE,#3B82F6)'
                                       : 'linear-gradient(135deg,#FBCFE8,#EC4899)';
            $avatarBorder = $isMale   ? 'rgba(59,130,246,0.35)' : 'rgba(236,72,153,0.35)';
            $avatarShadow = $isMale   ? 'rgba(59,130,246,0.18)' : 'rgba(236,72,153,0.18)';

            // Badge role
            $roleBg    = $isGA ? 'rgba(245,168,0,0.13)' : 'rgba(16,185,129,0.12)';
            $roleColor = $isGA ? '#D48900'               : '#065f46';
            $roleBorder= $isGA ? 'rgba(245,168,0,0.3)'  : 'rgba(16,185,129,0.3)';
            $roleLabel = $isGA ? 'General Affair'        : 'Staf';
            $roleIcon  = $isGA ? '🏷' : '👤';
        @endphp

        <div
            wire:key="user-card-{{ $record->id }}"
            style="
                position:relative; overflow:hidden;
                border-radius:18px; background:#FFFBF3;
                border:1.5px solid rgba(245,168,0,0.2);
                box-shadow:0 2px 8px rgba(26,10,0,0.06);
                margin-bottom:10px;
            "
        >
            {{-- Header strip dengan avatar --}}
            <div style="
                background:linear-gradient(135deg, rgba(245,168,0,0.08), rgba(217,79,0,0.05));
                padding:16px 16px 0;
                display:flex; align-items:flex-end; gap:14px;
                border-bottom:1px solid rgba(245,168,0,0.15);
            ">
                {{-- Avatar --}}
                <div style="
                    flex-shrink:0;
                    width:60px; height:60px;
                    border-radius:50%;
                    background:{{ $avatarBg }};
                    border:2.5px solid {{ $avatarBorder }};
                    box-shadow:0 4px 12px {{ $avatarShadow }};
                    display:flex; align-items:center; justify-content:center;
                    margin-bottom:-1px;
                    position:relative;
                ">
                    @if ($isMale)
                        {{-- Ikon pria --}}
                     <svg xmlns="http://www.w3.org/2000/svg" width="29.34" height="32" viewBox="0 0 22 24">
	<path d="M0 0h22v24H0z" fill="none" />
	<path fill="currentColor" d="M14.145 16.629a24 24 0 0 1-.052-2.525l-.001.037a4.85 4.85 0 0 0 1.333-2.868l.002-.021c.339-.028.874-.358 1.03-1.666a1.22 1.22 0 0 0-.455-1.218l-.003-.002c.552-1.66 1.698-6.796-2.121-7.326C13.485.35 12.479 0 11.171 0c-5.233.096-5.864 3.951-4.72 8.366a1.22 1.22 0 0 0-.455 1.229l-.001-.008c.16 1.306.691 1.638 1.03 1.666a4.86 4.86 0 0 0 1.374 2.888a25 25 0 0 1-.058 2.569l.005-.081C7.308 19.413.32 18.631 0 24h22.458c-.322-5.369-7.278-4.587-8.314-7.371z" />
</svg>


                    @elseif ($isFemale)
                        {{-- Ikon wanita --}}
                       <svg xmlns="http://www.w3.org/2000/svg" width="29.34" height="32" viewBox="0 0 22 24">
	<path d="M0 0h22v24H0z" fill="none" />
	<path fill="currentColor" d="M14.041 16.683a15 15 0 0 1-.035-.72c2.549-.261 4.338-.872 4.338-1.585c-.007 0-.006-.03-.006-.041C16.432 12.619 19.99.417 13.367.663a3.34 3.34 0 0 0-2.196-.664h.008C2.208.677 6.175 12.202 4.13 14.377h-.004c.008.698 1.736 1.298 4.211 1.566c-.007.17-.022.381-.054.734C7.256 19.447.321 18.671.001 24h22.294c-.319-5.33-7.225-4.554-8.253-7.317z" />
</svg>

                    @else
                        {{-- Placeholder netral --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="width:30px;height:30px;" fill="none" stroke="#8B5E3C" stroke-width="1.5">
                            <circle cx="12" cy="8" r="4"/>
                            <path stroke-linecap="round" d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                        </svg>
                    @endif

                    {{-- Gender dot --}}
                    <div style="
                        position:absolute; bottom:1px; right:1px;
                        width:14px; height:14px;
                        border-radius:50%;
                        background:{{ $isMale ? '#3B82F6' : ($isFemale ? '#EC4899' : '#9ca3af') }};
                        border:2px solid #FFFBF3;
                        display:flex; align-items:center; justify-content:center;
                        font-size:7px; color:#fff; font-weight:900;
                        line-height:1;
                    ">{{ $isMale ? '♂' : ($isFemale ? '♀' : '?') }}</div>
                </div>

                {{-- Nama & email --}}
                <div style="flex:1; min-width:0; padding-bottom:14px;">
                    <p style="font-size:15px; font-weight:700; color:#3D1C02; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; margin-bottom:2px;">
                        {{ $record->name }}
                    </p>
                    <p style="font-size:12px; color:#8B5E3C; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; opacity:0.85;">
                        {{ $record->email }}
                    </p>
                </div>
            </div>

            {{-- Info baris: role & gender --}}
            <div style="display:flex; gap:8px; padding:12px 16px; align-items:center;">

                {{-- Role badge --}}
                <span style="
                    display:inline-flex; align-items:center; gap:4px;
                    background:{{ $roleBg }}; color:{{ $roleColor }};
                    border:1px solid {{ $roleBorder }};
                    font-size:10px; font-weight:700;
                    letter-spacing:0.06em; text-transform:uppercase;
                    padding:3px 9px; border-radius:99px;
                ">
                    {{ $roleIcon }} {{ $roleLabel }}
                </span>

                {{-- Gender label --}}
                <span style="
                    display:inline-flex; align-items:center; gap:4px;
                    background:{{ $isMale ? 'rgba(59,130,246,0.1)' : ($isFemale ? 'rgba(236,72,153,0.1)' : '#f3f4f6') }};
                    color:{{ $isMale ? '#1D4ED8' : ($isFemale ? '#BE185D' : '#6b7280') }};
                    border:1px solid {{ $isMale ? 'rgba(59,130,246,0.25)' : ($isFemale ? 'rgba(236,72,153,0.25)' : '#e5e7eb') }};
                    font-size:10px; font-weight:700;
                    letter-spacing:0.06em; text-transform:uppercase;
                    padding:3px 9px; border-radius:99px;
                ">
                    {{ $isMale ? '♂ Laki-laki' : ($isFemale ? '♀ Perempuan' : '—') }}
                </span>

            </div>

            {{-- Action row --}}
            <div style="display:flex; border-top:1px solid rgba(245,168,0,0.15);">

                {{-- Edit --}}
                <a
                    href="{{ UserResource::getUrl('edit', ['record' => $record]) }}"
                    style="
                        flex:1; display:flex; align-items:center; justify-content:center; gap:5px;
                        padding:11px 0; font-size:11px; font-weight:600; color:#1447e6;
                        text-decoration:none; border-right:1px solid rgba(245,168,0,0.15);
                    "
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none">
                        <g fill="none">
                            <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                            <path fill="currentColor" d="M13 3a1 1 0 0 1 .117 1.993L13 5H5v14h14v-8a1 1 0 0 1 1.993-.117L21 11v8a2 2 0 0 1-1.85 1.995L19 21H5a2 2 0 0 1-1.995-1.85L3 19V5a2 2 0 0 1 1.85-1.995L5 3zm6.243.343a1 1 0 0 1 1.497 1.32l-.083.095l-9.9 9.899a1 1 0 0 1-1.497-1.32l.083-.094z"/>
                        </g>
                    </svg>
                    Edit
                </a>

                {{-- Hapus --}}
                <button
                    wire:click="deleteRecord({{ $record->id }})"
                    wire:confirm="Yakin hapus pengguna '{{ addslashes($record->name) }}'?"
                    style="
                        flex:1; display:flex; align-items:center; justify-content:center; gap:5px;
                        padding:11px 0; font-size:11px; font-weight:600; color:#ef4444;
                        background:none; border:none; cursor:pointer;
                    "
                >
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>

            </div>
        </div>
    @empty
        <div style="text-align:center; padding:48px 0;">
            <div style="font-size:48px; margin-bottom:12px;">👥</div>
            <p style="font-size:15px; font-weight:600; color:#374151;">Belum ada pengguna</p>
            <p style="font-size:13px; color:#9ca3af; margin-top:4px;">
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
        <div style="display:flex; align-items:center; justify-content:space-between; gap:8px; margin-top:12px; margin-bottom:4px;">
            @if ($records->onFirstPage())
                <span style="flex:1;border-radius:12px;border:1px solid #e5e7eb;padding:10px 0;text-align:center;font-size:13px;font-weight:500;color:#d1d5db;">← Prev</span>
            @else
                <button wire:click="previousPage('user_page')" style="flex:1;border-radius:12px;border:1px solid #e5e7eb;background:#fff;padding:10px 0;text-align:center;font-size:13px;font-weight:600;color:#374151;cursor:pointer;">← Prev</button>
            @endif

            <span style="font-size:12px;color:#9ca3af;white-space:nowrap;">{{ $records->currentPage() }} / {{ $records->lastPage() }}</span>

            @if ($records->hasMorePages())
                <button wire:click="nextPage('user_page')" style="flex:1;border-radius:12px;background:linear-gradient(135deg,#F5A800,#D94F00);border:none;padding:10px 0;text-align:center;font-size:13px;font-weight:600;color:#fff;cursor:pointer;">Next →</button>
            @else
                <span style="flex:1;border-radius:12px;border:1px solid #e5e7eb;padding:10px 0;text-align:center;font-size:13px;font-weight:500;color:#d1d5db;">Next →</span>
            @endif
        </div>
    @endif

</div>