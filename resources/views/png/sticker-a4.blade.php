<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
@page{
    size: A4 portrait;
   margin:5mm;
}

body{
    margin:0;
    padding:0;
    font-family:Arial, sans-serif;
    font-size:9pt;
    background:#fff;
}

.sheet{
    width:210mm;
    min-height:297mm;
    background:#fff;
    padding:5mm;
    box-sizing:border-box;
    margin:auto;
}

.page{
    page-break-after:always;
    margin-bottom:10mm;
}

.page:last-child{
    page-break-after:auto;
}

.sticker{
    width:95mm;
    height:30mm;
    border:2px solid #000;
    border-collapse:collapse;
}

.sticker td{
    padding:0;
}

.logo-cell{
    width:16mm;
    text-align:center;
    vertical-align:middle;
}

.logo-cell img{
    max-width:15mm;
    max-height:15mm;
}

.info-cell{
    vertical-align:top;
    padding:1mm !important;
}

.qr-cell{
    width:15mm;
    text-align:center;
    vertical-align:middle;
}

.qr-cell img{
    width:20mm;
    height:20mm;
}

.item-name{
    font-size:10pt;
    font-weight:bold;
    line-height:1.2;
    padding-top:2mm;
    height:6mm;
    overflow:hidden;
}

.item-code{
    font-size:10pt;
    font-weight:bold;
    border-top:2px solid #000;
    padding-top:3mm;
}

.company{
    height:8mm;
    border-top:2px solid #000;
    text-align:center;
    font-size:10pt;
    font-weight:bold;
    vertical-align:middle;
}
</style>
</head>
<body>

@foreach($items->chunk(16) as $page)

<div class="sheet page">

    <table width="100%" cellspacing="2" cellpadding="0">

        @foreach($page->chunk(2) as $row)

        <tr>

            @foreach($row as $item)

            <td width="50%" valign="top">

                <table class="sticker">

                    <tr>

                        <td class="logo-cell">

                            @if($item->company?->logo)
                                <img
                                    src="data:image/png;base64,{{ base64_encode(Storage::disk('public')->get($item->company->logo)) }}"
                                    alt="Logo"
                                >
                            @endif

                        </td>

                        <td class="info-cell">

                            <div class="item-name">
                                {{ Str::limit($item->name, 40) }}
                            </div>

                            <div class="item-code">
                                Kode: {{ $item->code }}
                            </div>

                        </td>

                        <td class="qr-cell">

                            <img
                                src="{{ $item->qr_image }}"
                                alt="QR Code"
                            >

                        </td>

                    </tr>

                    <tr>

                        <td colspan="3" class="company">
                            {{ $item->company->company_name }}
                        </td>

                    </tr>

                </table>

            </td>

            @endforeach

            @if($row->count() == 1)
                <td width="50%"></td>
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