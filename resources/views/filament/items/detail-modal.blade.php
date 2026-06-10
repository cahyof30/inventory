{{-- resources/views/filament/items/detail-modal.blade.php --}}
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

        /* Berikan efek transisi pada SVG di dalam tombol */
.btn[data-bs-toggle="collapse"] svg {
    transition: transform 0.3s ease;
}

/* Ketika tombol diklik (aria-expanded="true"), putar SVG 180 derajat */
.btn[data-bs-toggle="collapse"][aria-expanded="true"] svg {
    transform: rotate(180deg);
}
    </style>

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<div class="card" style="display: flex; flex-direction: column;justify-content: center; align-items: center !important;">

   <div class="title" style="display: flex; justify-content: center; align-items: center;">
    <img src="{{ asset('storage/'.$record->company?->logo) }}" alt="Logo" style="height:100px; vertical-align:middle;">
</div>
   <div class="title" style="display: flex; justify-content: center; align-items: center;">
    <img src="{{ $record->image ? asset('storage/'.$record->image) : asset('assets/no_picture.png') }}" alt="Logo" style="width:60%; vertical-align:middle;">
</div>
    <div class="title">
        Informasi Aset SGM Group
    </div>

    <table>

        <tr>
            <td width="180">Kode Barang</td>
            <td>{{ $record->code }}</td>
        </tr>

        <tr>
            <td>Nama Barang</td>
            <td>{{ $record->name }}</td>
        </tr>

        <tr>
            <td>Perusahaan</td>
            <td>{{ $record->company?->company_name }}</td>
        </tr>

        <tr>
            <td>Lokasi</td>
            <td>{{ $record->location?->name }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>

<small class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2">Verified</small>
</td>
        </tr>
    </table>

</div>
{{-- <div class="space-y-4">
    <div>
        <strong>Nama Barang:</strong><br>
        {{ $record->name }}
    </div>

    <div>
        <strong>Kategori:</strong><br>
        {{ $record->category?->name }}
    </div>

    <div>
        <strong>Merek:</strong><br>
        {{ $record->brand }}
    </div>

    <div>
        <strong>Harga Beli:</strong><br>
        Rp {{ number_format($record->purchase_price, 0, ',', '.') }}
    </div>

    @if($record->image)
        <img
            src="{{ asset('storage/'.$record->image) }}"
            class="rounded-lg max-w-xs"
        >
    @endif
</div> --}}