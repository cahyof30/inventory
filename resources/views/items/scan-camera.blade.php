<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scan QR</title>


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
   <div id="reader" style="width:500px"></div>
</div>
    <div class="title">
     Scan QR Asset
    </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>





<script src="https://unpkg.com/html5-qrcode"></script>

<script>
let isProcessing = false;

const html5QrCode = new Html5Qrcode("reader");

async function onScanSuccess(decodedText) {

    if (isProcessing) {
        return;
    }

    // Validasi QR terlebih dahulu
    if (!isValidQrUrl(decodedText)) {

        document.querySelector('.title').innerHTML = `
            <div class="text-center">

                <div style="font-size:64px;">
                    ⚠️
                </div>

                <div class="fw-bold text-danger">
                    QR Tidak Valid
                </div>

                <div class="text-muted mt-2">
                    QR ini bukan berasal dari sistem inventaris SGM.
                </div>

            </div>
        `;

        return;
    }

    isProcessing = true;

    await html5QrCode.stop();

    document.getElementById('reader').style.display = 'none';

    document.querySelector('.title').innerHTML = `
        <div class="text-center">

            <div style="font-size:64px;">
                📦
            </div>

            <div class="fw-bold text-success">
                QR Berhasil Terdeteksi
            </div>

            <div class="text-muted">
                Membuka informasi aset...
            </div>

        </div>
    `;

    setTimeout(() => {
        window.location.href = decodedText;
    }, 500);
}

function onScanFailure(error) {
    // Biarkan kosong
}

function isValidQrUrl(url) {

    try {

        const parsed = new URL(url);

        return (
            parsed.protocol === 'https:' &&
            parsed.hostname === window.location.hostname &&
            parsed.pathname.startsWith('/asset/')
        );

    } catch {

        return false;
    }
}

html5QrCode.start(
    {
        facingMode: "environment"
    },
    {
        fps: 10,
        qrbox: {
            width: 250,
            height: 250
        }
    },
    onScanSuccess,
    onScanFailure
).catch(error => {

    console.error(error);

    alert("Gagal mengakses kamera: " + error);

});
</script>

</body>
</html>