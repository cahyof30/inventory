<x-filament-panels::page>

    <x-filament::section>

        <div id="reader" style="max-width:600px;margin:auto"></div>
 
        <div id="status-area" class="mt-4"></div>

         

    </x-filament::section>

    @push('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>

<script>
let isProcessing = false;

const html5QrCode = new Html5Qrcode("reader");

async function onScanSuccess(decodedText) {

    if (isProcessing) {
        return;
    }

    if (!isValidQrUrl(decodedText)) {

    try {
        await html5QrCode.stop();
    } catch (e) {
        console.error(e);
    }

    document.getElementById('reader').style.display = 'none';

    showError(
        'QR ini bukan berasal dari sistem inventaris SGM Group.'
    );

    return;
}

    isProcessing = true;

    try {

        await html5QrCode.stop();

    } catch (error) {

        console.error(error);

    }

    document.getElementById('reader').style.display = 'none';

    showSuccess();

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

        const allowedPaths = [
            '/scan/',
            '/asset/'
        ];

        return (
            parsed.protocol === 'https:' &&
            parsed.hostname === window.location.hostname &&
            allowedPaths.some(path =>
                parsed.pathname.startsWith(path)
            )
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

function showSuccess() {

    document.getElementById('status-area').innerHTML = `
        <div class="text-center">

            <div style="font-size:64px;">📦</div>

            <div class="fw-bold text-success fs-5">
                QR Berhasil Terdeteksi
            </div>

            <div class="text-muted">
                Membuka informasi aset...
            </div>

            <div class="spinner-border text-success mt-3"></div>

        </div>
    `;
}



function showError(message) {

    document.getElementById('status-area').innerHTML = `
        <div class="text-center">

            <div style="font-size:72px;">❌</div>

            <div class="fw-bold text-danger fs-4">
                QR Tidak Valid
            </div>

            <div class="text-muted mt-2">
                ${message}
            </div>

            <button
                class="btn btn-primary mt-4"
                onclick="restartScanner()"
            >
                📷 Scan QR Lagi
            </button>

        </div>
    `;
}
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
        
    @endpush

</x-filament-panels::page>

   