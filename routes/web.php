<?php

use App\Http\Controllers\PdfController;
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