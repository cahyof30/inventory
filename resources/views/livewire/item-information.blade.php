<x-item-detail-style />

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
<div class="card-wrapper">

    <x-item-detail-search-form />

    @if($item)

        <div class="card">

            <x-item-detail-header
                :item="$item" />

            <x-item-detail-public-information
                :item="$item" />

            <x-item-detail-confidential-information
                :item="$item" />

            <x-item-detail-action-button
                :item="$item" />

        </div>

    @endif

</div>

<x-item-detail-scripts />
