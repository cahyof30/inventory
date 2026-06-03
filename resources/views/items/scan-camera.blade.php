<!DOCTYPE html>
<html>
<head>
    <title>Scan QR</title>
</head>
<body>

<h2>Scan QR Asset</h2>

<div id="reader" style="width:500px"></div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>

function onScanSuccess(decodedText){
    window.location.href = decodedText;
}

function onScanFailure(error){
    // kosong saja
}

const html5QrCode = new Html5Qrcode("reader");

html5QrCode.start(
    { facingMode: "environment" },
    {
        fps: 10,
        qrbox: 250
    },
    onScanSuccess,
    onScanFailure
)
.catch(err => {
    console.error(err);
    alert(err);
});

</script>

</body>
</html>