<?php
namespace App\Livewire;

use App\Models\Item;
use App\Models\ItemScanLog;
use App\Services\RecaptchaService;
use Livewire\Component;

class ItemInformation extends Component
{
    public string $code = '';

    public string $recaptchaToken = '';

    public ?Item $item = null;

    public function mount(?string $uuid = null): void
    {
        // if ($uuid) {
        //     $this->item = Item::where('public_uuid', $uuid)->firstOrFail();
        // }
         if (!$uuid) {
        return;
    }

    $this->item = Item::with([
        'company',
        'location',
    ])->where(
        'public_uuid',
        $uuid
    )->firstOrFail();

    ItemScanLog::create([
        'item_id'    => $this->item->id,
        'ip'         => request()->ip(),
        'user_agent' => request()->userAgent(),
        'scanned_at' => now(),
    ]);
    }

    public function search(): void
    {
        $this->validate([
            'code' => 'required',
            'recaptchaToken' => 'required',
        ]);

        if (! RecaptchaService::verify($this->recaptchaToken)) {
            $this->addError('code', 'Verifikasi reCAPTCHA gagal.');
            return;
        }

        $this->item = Item::where('code', $this->code)->first();

        if (! $this->item) {
            $this->addError('code', 'Kode barang tidak ditemukan.');
            return;
        }

        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.item-information');
    }
}