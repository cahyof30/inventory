<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
@page {
    size: A4 portrait;
    margin: 5mm;
}

body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    font-size: 9pt;
    background: #fff;
}

.sheet {
    width: 210mm;
    min-height: 297mm;
    background: #fff;
    padding: 5mm;
    box-sizing: border-box;
    margin: auto;
}

.page {
    page-break-after: always;
    margin-bottom: 10mm;
}

.page:last-child {
    page-break-after: auto;
}

/* Mengubah stiker menjadi satu kolom terpusat */
.sticker {
    width: 45mm;
    border: 2px solid #000;
    border-collapse: collapse;
    margin: 5mm auto;
    text-align: center;
}

.sticker td {
    padding: 0;
}

/* QR Code diletakkan di atas dengan ukuran penuh */
.qr-cell {
    text-align: center;
    vertical-align: middle;
    padding: 2mm;
}

.qr-cell img {
    width: 35mm;
    height: 35mm;
    display: block;
    margin: 0 auto;
}

/* Kode diletakkan di bawah QR Code */
.code-cell {
    font-size: 10pt;
    font-weight: bold;
    text-align: center;
    padding: 2mm 0;
    border-top: 2px solid #000;
    background-color: #f9f9f9;
}
</style>
</head>
<body>

@foreach($items->chunk(16) as $page)

<div class="sheet page">

    <table width="100%" cellspacing="2" cellpadding="0">

        @foreach($page->chunk(4) as $row) <tr>

            @foreach($row as $item)

            <td width="25%" valign="top">

                <table class="sticker">

                    <tr>
                        <td class="qr-cell">
                            <img src="{{ $item->qr_image }}" alt="QR Code">
                        </td>
                    </tr>

                    <tr>
                        <td class="code-cell">
                            Kode: {{ $item->code }}
                        </td>
                    </tr>

                </table>

            </td>

            @endforeach

            @if($row->count() < 4)
                @for($i = 0; $i < (4 - $row->count()); $i++)
                    <td width="25%"></td>
                @endfor
            @endif

        </tr>

        @endforeach

    </table>

</div>

@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
async function downloadPNG(){

    const pages = document.querySelectorAll('.page');

    for(let i = 0; i < pages.length; i++){

        const canvas = await html2canvas(pages[i],{
            scale:4,
            useCORS:true,
            backgroundColor:'#ffffff'
        });

        const link = document.createElement('a');

        link.download = 'stiker-page-' + (i + 1) + '.png';

        link.href = canvas.toDataURL('image/png');

        link.click();

        await new Promise(resolve => setTimeout(resolve, 500));
    }
}
</script>

@if($autoDownload)
<script>
window.addEventListener('load', function () {
    downloadPNG();
});
</script>
@endif

</body>
</html>