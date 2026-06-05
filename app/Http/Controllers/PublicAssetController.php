<?php

namespace App\Http\Controllers;

use App\Models\Item;

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

    return view(
        'items.scan-camera',
        compact('item')
    );
}
}
