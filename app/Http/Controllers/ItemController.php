<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchItemRequest;
use App\Models\Item;
use App\Models\ItemScanLog;
use App\Services\RateLimitService;
use App\Services\RecaptchaService;
use BanService;

class ItemController extends Controller
{
    public function scan(string $uuid)
    {
        //      return view('pages.item', [
        //     'uuid' => $uuid,
        // ]);
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
            'items.scan',
            compact('item')
        );
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

    public function search(SearchItemRequest $request)
    {
        $ip = $request->ip();

        // if (BanService::isBanned($ip)) {
        //     return back()->withErrors([
        //         'code' => 'IP Anda diblokir sementara.',
        //     ]);
        // }

        // if (! RateLimitService::check($ip)) {
        //     return back()->withErrors([
        //         'code' => 'Terlalu banyak permintaan.',
        //     ]);
        // }

        if (! RecaptchaService::verify($request->recaptchaToken)) {

            BanService::failed($ip);

            return back()
                ->withInput()
                ->withErrors([
                    'code' => 'Verifikasi reCAPTCHA gagal.',
                ]);
        }

        $item = Item::where('code', $request->code)->first();

        if (! $item) {

            // BanService::failed($ip);

            return back()
                ->withInput()
                ->withErrors([
                    'code' => 'Kode barang tidak ditemukan.',
                ]);
        }

        BanService::success($ip);

        return redirect()->route('items.scan', $item->public_uuid);
    }
}
