<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemScanLog;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function scan(string $code)
{
    $item = Item::with([
        'company',
        'location',
    ])
    ->where('code', $code)
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
    public function scannew(string $code)
{
    $item = Item::with([
        'company',
        'location',
    ])
    ->where('code', $code)
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
