<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemScanLog;

class PublicAssetController extends Controller
{
    public function show(string $uuid)
{
    $item = Item::query()
        ->where('public_uuid', $uuid)
        ->first();

    if (! $item) {

        return response()->view(
            'public.asset-not-found',
            [],
            404
        );
    }

     ItemScanLog::create([
            'item_id' => $item->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'scanned_at' => now(),
        ]);

    return view(
        // 'items.scan-camera',
        'filament.pages.scan-qr',
        compact('item')
    );
}
}
