@if(auth()->check())

   <button
    class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-center gap-2"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#confidentialInfo"
    aria-expanded="false"
    aria-controls="confidentialInfo"
>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path d="M0 0h24v24H0z" fill="none" />
        <path fill="currentColor" d="M21.886 5.536A1 1 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13a.998.998 0 0 0 1.644 0l9-13a1 1 0 0 0 .064-1.033M12 17.243L4.908 7h14.184z" />
    </svg> 
    Lihat Informasi Lengkap
</button>
        <div class="collapse mt-3" id="confidentialInfo">

            <div>

                <table>

                    <tr>
                        <td width="180"><strong>Harga Beli</strong></td>
                        <td>
                            Rp {{ number_format($item->purchase_price, 0, ',', '.') }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Tanggal Beli</strong></td>
                        <td>
                            {{ \Carbon\Carbon::parse($item->purchase_date)->format('d F Y') }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Vendor</strong></td>
                        <td>
                            {{ $item->vendor?->name ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Merek</strong></td>
                        <td>
                            {{ $item->brand ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Kondisi</strong></td>
                        <td>
                            @if ($item->condition == 'good')
                            <small class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2">Baik</small>
                            @elseif ($item->condition == 'broken')
                            <small class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-2">Rusak</small>
                            @endif
                            {{-- {{ ucfirst($item->condition) }} --}}
                        </td>
                    </tr>

                </table>

            </div>

        </div>

@else

<a href="{{ route('filament.admin.auth.login') }}"
   onclick="event.preventDefault(); window.location.href=this.href;"
            class="btn btn-outline-secondary w-100"
            type="button"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
	<path d="M0 0h24v24H0z" fill="none" />
	<path fill="currentColor" d="M21.886 5.536A1 1 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13a.998.998 0 0 0 1.644 0l9-13a1 1 0 0 0 .064-1.033M12 17.243L4.908 7h14.184z" />
</svg>
 Lihat Informasi Lengkap (Harus Login)
</a>
@endif