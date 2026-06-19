<?php

namespace App\Http\Controllers;

use App\Models\Item;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Http\Request;

class PngController extends Controller
{
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

        return view('png.sticker-a4', [
            'items' => $items,
            'autoDownload' => $request->boolean('download'),
        ]);
    }
    public function previewStickerA3(Request $request)
    {
        $ids = explode(',', $request->ids);

        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'scale' => 6,
            'imageBase64' => true,
        ]);

        $items = Item::whereIn('id', $ids)->get();

        $items->transform(function ($item) use ($options) {

            $item->qr_image = (new QRCode($options))
                ->render($item->qr_code);

            return $item;
        });

        return view('png.sticker-a3', [
            'items' => $items,
            'autoDownload' => $request->boolean('download'),
        ]);
    }
}
