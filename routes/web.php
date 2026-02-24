<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/admin/login');
});

Route::get('/update-db', function () {
    Artisan::call('migrate:fresh --force'); // Hati-hati: fresh akan menghapus data lama
    // Atau gunakan: Artisan::call('migrate --force');
    return "Database updated!";
});