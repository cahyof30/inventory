<?php
namespace App\Livewire;

use App\Models\Item;
use App\Models\ItemScanLog;
use App\Services\RecaptchaService;
use Illuminate\Support\Facades\Http;
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

    public function recaptchaSearch(): void
    {
        $token = request()->input('recaptchaToken');
        $this->validate([
            'code' => 'required',
            'recaptchaToken' => 'required',
        ]);

        // if (! RecaptchaService::verify($this->recaptchaToken)) {
        //     $this->addError('code', 'Verifikasi reCAPTCHA gagal.');
        //     return;
        // }
        // 🔥 VERIFY GOOGLE RECAPTCHA
        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $this->recaptchaToken,
                'remoteip' => request()->ip(),
            ]
        )->json();

        if (!($response['success'] ?? false)) {
            $this->addError('code', 'reCAPTCHA gagal. Coba lagi.');
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