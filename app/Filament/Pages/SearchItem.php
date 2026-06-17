<?php

namespace App\Filament\Pages;

use App\Models\Item;
use App\Services\RecaptchaService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SearchItem extends Page
{
    protected string $view = 'filament.pages.search-item';

    public string $code = '';

    public string $recaptchaToken = '';

    public function search()
    {
        if (! RecaptchaService::verify($this->recaptchaToken)) {

            Notification::make()
                ->danger()
                ->title('Verifikasi reCAPTCHA gagal')
                ->send();

            return;
        }

        $item = Item::where('code', $this->code)->first();

        if (! $item) {

            Notification::make()
                ->warning()
                ->title('Barang tidak ditemukan')
                ->send();

            return;
        }

        return redirect()->route('scan.item', $item->uuid);
    }
}