<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemScanLog;

class ItemController extends Controller
{
    public function scan(string $uuid)
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
}
