<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
@page {
    margin: 5mm;
}

body{
    margin:0;
    padding:0;
    font-family: Arial, sans-serif;
}

.sheet{
    width:100%;
}

.sticker{
    width:95mm;
    height:25mm;
    border:1px solid #000;
}

.sticker-table{
    width:100%;
    height:100%;
    border-collapse:collapse;
}

.logo-cell{
    width:18mm;
    text-align:center;
    vertical-align:middle;
}

.info-cell{
    width:auto;
    vertical-align:top;
    padding-left:2mm;
}

.qr-cell{
    width:18mm;
    text-align:center;
    vertical-align:middle;
}

.item-name{
    font-size:10pt;
    padding-top:2mm;
    font-weight:bold;
    height:6mm;
}

.item-code{
    border-top:2px solid #000;
    font-size:9pt;
    padding-top:1mm;
    font-weight:bold;
}

.company{
    text-align:center;
    font-weight:bold;
    font-size:9pt;
    border-top:1px solid #000;
}
</style>
</head>
<body>

<table width="100%" cellspacing="2" cellpadding="0">

@foreach($items->chunk(2) as $row)

<tr>

@foreach($row as $item)

<td width="50%" valign="top">

<table class="sticker sticker-table">

<tr height="20mm">

<td class="logo-cell">

@if($item->company?->logo)

<img
    src="{{ asset('storage/'.$item->company->logo) }}"
    width="45"
/>

@endif

</td>

<td class="info-cell">

<div class="item-name">
Nama: {{ $item->name }}
</div>

<div class="item-code">
Kode: {{ $item->code }}
</div>

</td>

<td class="qr-cell">

@php

$png = 
   QrCode::size(13)
   ->margin(1)
   ->generate($item->qr_code)
;

@endphp

{{-- <img
    src="data:image/png;base64,{{ $png }}"
    style="width:13mm;height:13mm;"
> --}}

  {!! QrCode::size(50)
        ->margin(0)
        ->generate($item->qr_code) !!}
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

</body>
</html>