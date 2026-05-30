<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
   public function printStickers(Request $request)
    {
        $ids = explode(',', $request->ids);

        $items = Item::whereIn('id', $ids)->get();

        $pdf = Pdf::loadView(
            'pdf.sticker',
            compact('items')
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('stiker-inventaris.pdf');
    }
}
