<?php

namespace App\Models;

use App\Models\Traits\HasInventoryCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, HasInventoryCode;

    protected $fillable = [
        'code',
        'company_id',
        'category_id',
        'name',
        'brand',
        'purchase_price',
        'purchase_date',
        'condition',
        'image',
        'qr_code',
        'description',
        'specifications',
    ];

    public $timestamps = true;

    protected $casts = [
        'specifications' => 'array',
    ];

    public function generateQr(): void
    {
        if ($this->code && $this->brand && $this->name) {
            $this->qr_code = implode("\n", [
                $this->code,
                $this->brand,
                $this->name,
            ]);
        }
    }

    protected static function booted(): void
    {
       static::creating(function (Item $item) {
        // 1. Generate atau Update Kode Inventaris jika ada perubahan input
        // Kita gunakan !exists untuk data baru, isDirty untuk perubahan data lama
        if (!$item->exists || $item->isDirty(['company_id', 'category_id', 'purchase_date'])) {
            $item->generateInventoryCode();
        }

        // 2. Isi qr_code hanya dengan string kode saja
        if ($item->code) {
            $item->qr_code = $item->code;
        }
    });
        //     static::creating(function (Item $item) {
        //         $item->generateQr();
        //     });

        //     static::updating(function (Item $item) {
        //         $item->generateQr();
        //     });
    }

    public function category()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function scopeFixedAsset($query)
    {
        return $query->where('item_type', 'fixed_asset');
    }

    public function scopeConsumable($query)
    {
        return $query->where('item_type', 'consumable');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
