<?php

namespace App\Jobs;

use App\Models\Item;
use App\Services\GoogleSheetService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class SyncItemsToGoogleSheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Collection $items) {}

    public function handle(): void
    {
        $sheet = new GoogleSheetService();
        $rows = []; // Siapkan wadah untuk semua data

        foreach ($this->items as $item) {
            $conditionLabel = $item->condition === 'good' ? 'Baik' : 'Rusak';
            
            // Masukkan data ke array rows
            $rows[] = [
                $item->code,
                $item->company?->company_name,
                $item->category?->name,
                $item->name,
                $item->brand ?? '-',
                $item->location?->name ?? '-',
                $item->purchase_price,
                $item->purchase_date ?? '-',
                $conditionLabel,
                $item->description ?? '-',
            ];
        }

        // KIRIM SEKALIGUS (Batch Append)
        // Pastikan Anda memiliki method appendRows (jamak) di GoogleSheetService
        if (!empty($rows)) {
            $sheet->appendRows($rows); 
        }
    }
}
