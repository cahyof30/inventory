<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

        body{
            background:#e5e5e5;
            font-family:Arial, sans-serif;
            padding:20px;
        }

        .sheet{
            width:210mm;
            min-height:297mm;
            background:white;
            margin:auto;
            padding:5mm;
            box-sizing:border-box;
        }

        .sticker{
            width:95mm;
            height:25mm;

            border:1px solid #000;

            display:inline-block;
            vertical-align:top;

            margin-right:2mm;
            margin-bottom:2mm;

            box-sizing:border-box;

            padding:2mm;
        }

        .sticker-table{
            width:100%;
            height:100%;
            border-collapse:collapse;
        }

        .logo{
            width:15mm;
        }

        .logo svg{
            width:15mm !important;
            height:15mm !important;
        }

        .qr{
            width:15mm;
        }

        .qr svg{
            width:15mm !important;
            height:15mm !important;
        }

        .content{
            vertical-align:top;
            padding-left:2mm;
            margin-top:3mm;
        }

        .item-name{
            font-size:9pt;
            padding-top:2mm;
            font-weight:bold;
            padding-bottom:2mm;
        }

        .item-code{
            border-top:2px solid #000;
            font-size:9pt;
            padding-top:2mm;
        }

        .item-location{
            font-size:9pt;
            padding:2mm;
        }

        .item-company{
            padding-top:1mm !important;
            margin-bottom:-2mm;
            font-size:10pt;
            text-align:center;
            font-weight:bold;
        }

    </style>
</head>
<body>

<div class="sheet">

@foreach($items as $item)


<div class="sticker">
    <table width="100%">
        <tr>
            <td width="22%" valign="top">
              <div class="qr">
   @php
$svg = QrCode::size(100)
    ->margin(1)
    ->generate($item->qr_code);

$svg = str_replace("\n", '', $svg);

$dataUri = 'data:image/svg+xml;base64,' . base64_encode($svg);
@endphp

<img
    src="{{ $dataUri }}"
    width="70"
    height="70"
/>
</div>
            </td>

            <td width="78%" valign="top" halign="left">
                <div class="item-name">
                    {{ $item->name }}
                </div>

                <div class="item-code"  halign="left">
                    {{ $item->code }}
                </div>

                {{-- <div class="item-location">
                    {{ $item->location }}
                </div> --}}
            </td>
        </tr>
    </table>
</div>
{{-- <div class="sticker">

<div class="qr">
   @php
$svg = QrCode::size(100)
    ->margin(1)
    ->generate($item->qr_code);

$svg = str_replace("\n", '', $svg);

$dataUri = 'data:image/svg+xml;base64,' . base64_encode($svg);
@endphp

<img
    src="{{ $dataUri }}"
    width="70"
    height="70"
/>
</div> --}}

    <div class="content">

        <div class="item-name">
            {{ $item->name }}
        </div>

        <div class="item-code">
            {{ $item->code }}
        </div>

        <div class="item-location">
            {{ $item->location?->name }}
        </div>

    </div>

</div>

@endforeach

</div>

</body>
</html>