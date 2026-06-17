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