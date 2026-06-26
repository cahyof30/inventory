<?php

namespace App\Models\Traits;

use App\Models\Company;
use App\Models\ItemCategory;
use App\Models\Location;
use App\Models\LocationCategory;

trait HasInventoryCode
{
    public function generateInventoryCode(): void
    {
        // dd($this);
        $company = Company::find($this->company_id);
        $category = ItemCategory::find($this->category_id);
        $location = Location::with('locationCategory')
            ->find($this->location_id);

        $locationCode = $location?->locationCategory?->code;

        if (! $locationCode && ! empty($this->location_category_code)) {
            $locationCode = $this->location_category_code;
        }

        $locationCode ??= 'UNK';

        $companySlug  = $company->slug ?? 'UNK';
        $categoryCode = $category->code ?? 'UNK';
        $year = $this->created_at
            ? date('Y', strtotime($this->created_at))
            : date('Y');

//             // Sementara di HasInventoryCode, setelah baris $locationCode ??= 'UNK';
// dd([
//     'location_id'             => $this->location_id,
//     'location_from_db'        => $location?->name,
//     'locationCategory_code'   => $location?->locationCategory?->code,
//     'location_category_code'  => $this->location_category_code,
//     'final_locationCode'      => $locationCode,
// ]);
        // Format prefix
        if ($category?->code === 'KD') {
            // Format: COMPANY-KD-2026
            $prefix = "{$companySlug}-{$categoryCode}-{$year}";
        } elseif ($locationCode === 'V') {
            $prefix = "{$companySlug}-{$locationCode}-{$year}";
        } else {
            // Format: COMPANY-PE-I-2026
            $prefix = "{$companySlug}-{$categoryCode}-{$locationCode}-{$year}";
        }

        $last = static::where('company_id', $this->company_id)
            ->where('category_id', $this->category_id)
            ->where('code', 'like', "{$prefix}-%")
            ->latest('id')
            ->first();

        if ($last) {
            $parts = explode('-', $last->code);
            $number = (int) end($parts) + 1;
        } else {
            $number = 1;
        }

        $number = str_pad($number, 2, '0', STR_PAD_LEFT);

        $this->code = "{$prefix}-{$number}";
    }

    /**
     * Rebuild code without changing sequence number
     */
    public function rebuildInventoryCode(): void
    {
        $originalCode = $this->getOriginal('code');

        if (! $originalCode) {
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

        $this->code = $prefix.$sequence;
    }
}