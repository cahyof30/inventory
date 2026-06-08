<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informasi Aset</title>

    <style>
        body{
         font-family: Arial, sans-serif;
    margin: 0;
    min-height: 100vh;

    display: flex;
    justify-content: center;
    align-items: center;

    background: #f8f9fa;
        }
.card-wrapper {
            width: 100%;
            max-width: 600px; 
            padding: 20px;
        }
        .card{
            border:1px solid #ddd;
            padding:20px;
            border-radius:8px;
        }

        .title{
            font-size:24px;
            font-weight:bold;
            margin-bottom:20px;
        }

        table{
            width:100%;
        }

        td{
            padding:8px;
        }
    </style>

    	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
<div class="card-wrapper">
<div class="card" style="display: flex; flex-direction: column;justify-content: center; align-items: center !important;">

   <div class="title" style="display: flex; justify-content: center; align-items: center;">
    <img src="{{ asset('storage/'.$item->company?->logo) }}" alt="Logo" style="height:100px; vertical-align:middle;">
</div>
   <div class="title" style="display: flex; justify-content: center; align-items: center;">
    <img src="{{ $item->image ? asset('storage/'.$item->image) : asset('assets/no_picture.png') }}" alt="Logo" style="height:300px; vertical-align:middle;">
</div>
    <div class="title">
        Informasi Aset SGM Group
    </div>

    <table>

        <tr>
            <td width="180">Kode Barang</td>
            <td>{{ $item->code }}</td>
        </tr>

        <tr>
            <td>Nama Barang</td>
            <td>{{ $item->name }}</td>
        </tr>

        <tr>
            <td>Perusahaan</td>
            <td>{{ $item->company?->company_name }}</td>
        </tr>

        <tr>
            <td>Lokasi</td>
            <td>{{ $item->location?->name }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>

<small class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2">Verified</small>
</td>
        </tr>
@if(auth()->check())

<tr>
    <td colspan="2">

        <button
            class="btn btn-outline-dark w-100"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#confidentialInfo"
            aria-expanded="false"
            aria-controls="confidentialInfo"
        >
            🔒 Lihat Informasi Lengkap (Harus Login)
        </button>

        <div class="collapse mt-3" id="confidentialInfo">

            <div class="card card-body">

                <table class="table table-sm mb-0">

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
                            {{ ucfirst($item->condition) }}
                        </td>
                    </tr>

                </table>

            </div>

        </div>

    </td>
</tr>

@else

 <button
            class="btn btn-outline-secondary w-100"
            type="button"
        >
            🔒 Lihat Informasi Lengkap (Harus Login)
        </button>
@endif


        <tr>
         <td colspan="2">
    <div style="display: flex; gap: 10px; width: 100%; box-sizing: border-box;">
        
        <a href="{{ route('items.scan-camera') }}"
           style="
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 10px 20px;
                background: #007BFF;
                color: white;
                text-decoration: none;
                border-radius: 4px;
           ">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M17 12v4a1 1 0 0 1-1 1h-4m5-14h2a2 2 0 0 1 2 2v2m-4 1V7m4 10v2a2 2 0 0 1-2 2h-2M3 7V5a2 2 0 0 1 2-2h2m0 14h.01M7 21H5a2 2 0 0 1-2-2v-2" />
                    <rect width="5" height="5" x="7" y="7" rx="1" />
                </g>
            </svg>
            &nbsp;Scan QR Lain
        </a>

        @if(auth()->check())

<a href="{{ url('/admin') }}"
   style="
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 20px;
        background: #343a40;
        color: white;
        text-decoration: none;
        border-radius: 4px;
   ">
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <path d="M9 14L4 9l5-5"/>
            <path d="M4 9h11a5 5 0 0 1 5 5v3"/>
        </g>
    </svg>
    &nbsp;Dashboard Admin
</a>

@endif
        
    </div>
</td>
        </tr>

    </table>

</div>
</div>
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

</body>
</html>