<?php

namespace App\Observers;

use App\Models\Item;
use App\Services\GoogleSheetService;

class ItemObserver
{
    /**
     * Handle the Item "created" event.
     */
    public function created(Item $item): void
    {
        // sleep(1); // Beri jeda 1 detik tiap baris
        // $sheet = new GoogleSheetService;
        // $conditionLabel = match ($item->condition) {
        //     'good' => 'Baik',
        //     'broken' => 'Rusak',
        //     default => $item->condition,
        // };
        // $sheet->appendRows([
        //     $item->code,
        //     $item->company?->company_name,
        //     $item->category?->name,
        //     // $item->item_type,
        //     $item->name,
        //     $item->brand ?? '-',
        //     $item->location?->name ?? '-',
        //     $item->purchase_price,
        //     $item->purchase_date ?? '-',
        //     $conditionLabel,
        //     // $item->qr_code,
        //     $item->description ?? '-',
        // ]);
    }

    /**
     * Handle the Item "updated" event.
     */
    public function updated(Item $item): void
    {
        // sleep(1); // Beri jeda 1 detik tiap baris
        // $sheet = new GoogleSheetService;
        // $conditionLabel = match ($item->condition) {
        //     'good' => 'Baik',
        //     'broken' => 'Rusak',
        //     default => $item->condition,
        // };
        // $sheet->updateRowById($item->code, [
        //     $item->code,
        //     optional($item->company)->company_name,
        //     optional($item->category)->name,
        //     // $item->item_type,
        //     $item->name,
        //     $item->brand ?? '-',
        //     $item->location?->name ?? '-',
        //     $item->purchase_price,
        //     $item->purchase_date ?? '-',
        //     $conditionLabel,
        //     // $item->qr_code,
        //     $item->description ?? '-',
        // ]);
    }

    /**
     * Handle the Item "deleted" event.
     */
    public function deleted(Item $item): void
    {
        // $sheet = new GoogleSheetService;
        // $sheet->deleteRowById($item->code);
    }

    /**
     * Handle the Item "restored" event.
     */
    public function restored(Item $item): void
    {
        //
    }

    /**
     * Handle the Item "force deleted" event.
     */
    public function forceDeleted(Item $item): void
    {
        //
    }
}
