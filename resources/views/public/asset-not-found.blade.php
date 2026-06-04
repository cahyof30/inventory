<div class="container text-center mt-5">

    <div style="font-size:80px">
        ❌
    </div>

    <h3>Data Aset Tidak Ditemukan</h3>

    <p>
        QR berhasil dibaca, tetapi data aset
        tidak tersedia atau telah dihapus.
    </p>

  <button
    class="btn btn-primary mt-3"
    onclick="restartScanner()"
>
    Scan QR Lagi
</button>

    <script>
        async function restartScanner() {

    document.getElementById('reader').style.display = 'block';

    document.getElementById('status-area').innerHTML = `
        <div class="title">
            Scan QR Asset
        </div>
    `;

    isProcessing = false;

    try {

        await html5QrCode.start(
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
        );

    } catch (error) {

        console.error(error);

    }
}
        </script>
</div>