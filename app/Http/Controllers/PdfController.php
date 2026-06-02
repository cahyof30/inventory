<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function printStickers()
    {
       $options = new QROptions([
    'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    'scale' => 5,
    'imageBase64' => true,
]);

$items = Item::all();

$items->transform(function ($item) use ($options) {

    $item->qr_image = (new QRCode($options))
        ->render($item->qr_code);

    return $item;
});
}

public function previewSticker(Request $request)
{
    $ids = explode(',', $request->ids);

    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        'scale' => 5,
        'imageBase64' => true,
    ]);

    $items = Item::whereIn('id', $ids)->get();

    $items->transform(function ($item) use ($options) {

        $item->qr_image = (new QRCode($options))
            ->render($item->qr_code);

        return $item;
    });

    return view('pdf.sticker', [
        'items' => $items,
        'autoDownload' => $request->boolean('download'),
    ]);
}
}
