<?php

use App\Filament\Pages\AssetDetail;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PublicAssetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/admin/login');
});


Route::get('/items/print-stickers', [PdfController::class, 'printStickers'])
    ->name('items.print-sticker');

    use App\Models\Item;

Route::get('/preview-sticker', function () {

    $items = Item::take(18)->get();

    return view('pdf.stickers-preview', compact('items'));

});
Route::get('/prev2-sticker', function () {

    $items = Item::take(18)->get();

    return view('pdf.sticker-prev2', compact('items'));

});

Route::get(
    '/items/sticker',
    [PdfController::class, 'previewSticker']
)->name('items.sticker');

Route::get('/scan/{uuid}', [ItemController::class, 'scan'])
    ->name('items.scan');
Route::get('/scannew/{code}', [ItemController::class, 'scannew'])
    ->name('items.scannew');
Route::get(
    '/asset/{uuid}',
    [PublicAssetController::class, 'show']
)->name('asset.public');
    Route::get('/scan-camera', function () {
    return view('items.scan-camera');
})->name('items.scan-camera');

Route::get(
    '/admin/asset/{uuid}',
    AssetDetail::class
)->name('asset.detail');

Route::post('/search-item', [ItemController::class, 'search'])
    ->name('items.search');