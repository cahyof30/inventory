<?php

namespace App\Models;

use App\Models\Traits\HasInventoryCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory, HasInventoryCode;

    protected $fillable = [
        'public_uuid',
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
        'location_id',
        'description',
        'specification',
    ];

    public $timestamps = true;

    protected $casts = [
        'specification' => 'array',
    ];

    public function getQrUrlAttribute(): string
    {
        return url('/scan/'.$this->code);
    }

    public function generateQr(): void
    {
        // if ($this->code) {
        //     $this->qr_code = config('app.url')
        //         .'/inventory/public'
        //         .'/scan/'
        //         .urlencode($this->code);
        // }
        if ($this->code) {
            $this->qr_code = config('app.url')
                .'/scan/'
                .urlencode($this->public_uuid);
        }

    }


    protected static function booted(): void
    {
        static::creating(function (Item $item) {
            // 1. Generate atau Update Kode Inventaris jika ada perubahan input
                $item->generateInventoryCode();
            // Generate UUID publik
            if (empty($item->public_uuid)) {
                $item->public_uuid = Str::uuid();
            }

            // Isi QR
            if ($item->public_uuid) {
                $item->qr_code = route(
                    'asset.public',
                    $item->public_uuid
                );
            }

            // 2. Isi qr_code hanya dengan string kode saja
            // if ($item->code) {
            //     $item->qr_code = $item->code;
            // }
            $item->generateQr();
        });

         static::updating(function (Item $item) {

        if ($item->isDirty([
            'company_id',
            'category_id',
            'purchase_date'
        ])) {

            $item->generateInventoryCode();
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

    public function location()
    {
        return $this->belongsTo(Location::class);
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

    public function vehicleDetail()
    {
        return $this->hasOne(VehicleDetail::class, 'item_id');
    }
}
