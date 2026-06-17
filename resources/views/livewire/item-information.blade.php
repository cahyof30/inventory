<?php

use Livewire\Volt\Component;
use App\Models\Item;
use App\Services\RecaptchaService;

new class extends Component
{
    public string $code = '';

    public string $recaptchaToken = '';

    public ?Item $item = null;

    public function mount(?string $uuid = null)
    {
        if ($uuid) {
            $this->item = Item::where('public_uuid', $uuid)->first();
        }
    }

    public function search()
    {
        $this->validate([
            'code' => 'required',
            'recaptchaToken' => 'required',
        ]);

        if (! RecaptchaService::verify($this->recaptchaToken)) {

            $this->addError(
                'code',
                'Verifikasi reCAPTCHA gagal.'
            );

            return;
        }

        $this->item = Item::where(
            'code',
            $this->code
        )->first();

        if (! $this->item) {

            $this->item = null;

            $this->addError(
                'code',
                'Kode barang tidak ditemukan.'
            );

            return;
        }

        $this->resetErrorBag();

        $this->js("
            history.replaceState(
                {},
                '',
                '/scan/{$this->item->public_uuid}'
            );
        ");
    }
};

?>

<x-item-detail-style />

<div class="card-wrapper">

    <x-search-item />

    @if($item)

        <div class="card">

            <x-item-detail-header
                :item="$item" />

            <x-item-detail-public-information
                :item="$item" />

            <x-item-detail-confidential-information
                :item="$item" />

            <x-item-detail-action-button
                :item="$item" />

        </div>

    @endif

</div>

<x-item-detail-scripts />