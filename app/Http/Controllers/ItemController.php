<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemScanLog;
use App\Services\RecaptchaService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function scan(string $uuid)
    {
         return view('pages.item', [
        'public_uuid' => $uuid,
    ]);
        // $item = Item::with([
        //     'company',
        //     'location',
        // ])
        //     ->where('public_uuid', $uuid)
        //     ->firstOrFail();

        // ItemScanLog::create([
        //     'item_id' => $item->id,
        //     'ip' => request()->ip(),
        //     'user_agent' => request()->userAgent(),
        //     'scanned_at' => now(),
        // ]);

        // return view(
        //     'items.scan',
        //     compact('item')
        // );
    }

    public function scannew(string $uuid)
    {
        $item = Item::with([
            'company',
            'location',
        ])
            ->where('public_uuid', $uuid)
            ->firstOrFail();

        ItemScanLog::create([
            'item_id' => $item->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'scanned_at' => now(),
        ]);

        return view(
            'items.scannew',
            compact('item')
        );
    }

    // public function search(Request $request)
    // {
    //     $request->validate([
    //         'code' => 'required',
    //         'recaptchaToken' => 'required',
    //     ]);

    //     if (! RecaptchaService::verify($request->recaptchaToken)) {

    //         return back()->withErrors([
    //             'code' => 'Verifikasi reCAPTCHA gagal.',
    //         ]);
    //     }

    //     $item = Item::where('code', $request->code)->first();
    //     // dd($item);
    //     if (! $item) {

    //         return back()->withErrors([
    //             'code' => 'Kode barang tidak ditemukan.',
    //         ]);
    //     }

    //     return redirect()->route('items.scan', $item->public_uuid);
    // }
}
