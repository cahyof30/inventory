<?php

namespace App\Models\Traits;

trait HasInventoryCode
{
    protected static function bootHasInventoryCode(): void
    {
        static::creating(function ($model) {
            $model->generateInventoryCode();
        });

        // static::updating(function ($model) {

        //     if ($model->isDirty(['company_id', 'category_id', 'purchase_date'])) {
        //         $model->rebuildInventoryCode();
        //     }
        // });
    }

    /**
     * Generate full code (only for creating)
     */
    public function generateInventoryCode(): void
    {
        $companySlug = $this->company->slug ?? 'UNK';
        $categoryCode = $this->category->code ?? 'UNK';
        $year = $this->purchase_date
            ? date('Y', strtotime($this->purchase_date))
            : date('Y');

        $prefix = "{$companySlug}-{$categoryCode}-{$year}";

        $last = static::where('company_id', $this->company_id)
            ->where('category_id', $this->category_id)
            ->where('code', 'like', "{$prefix}%")
            ->latest('id')
            ->first();

        $number = $last ? ((int) substr($last->code, -5)) + 1 : 1;

        $this->code = $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Rebuild code without changing sequence number
     */
    public function rebuildInventoryCode(): void
    {
        $originalCode = $this->getOriginal('code');

        if (!$originalCode) {
            return;
        }

        // Ambil 5 digit terakhir (sequence)
        $sequence = substr($originalCode, -5);

        $companySlug = $this->company->slug ?? 'UNK';
        $categoryCode = $this->category->code ?? 'UNK';
        $year = $this->purchase_date
            ? date('Y', strtotime($this->purchase_date))
            : date('Y');

        $prefix = "{$companySlug}-{$categoryCode}-{$year}";

        $this->code = $prefix . $sequence;
    }
}