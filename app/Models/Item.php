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
        'pic_id',
        'image',
        'qr_code',
        'location_id',
        'description',
        'specification',
    ];

    public $timestamps = true;

    protected $casts = [
        'purchase_date' => 'date', // atau 'datetime'
        'specification' => 'array',
    ];

    public ?string $location_category_code = null;

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

    public bool $preserveCode = false;

    protected static function booted(): void
    {
        static::creating(function (Item $item) {
        // dd($item->getAttributes());
            // Generate code hanya jika belum ada
            if (blank($item->code)) {
                $item->generateInventoryCode();
            }

            // Generate UUID publik jika belum ada
            if (blank($item->public_uuid)) {
                $item->public_uuid = (string) Str::uuid();
            }

            // QR URL mengikuti public_uuid
            if (blank($item->qr_code)) {
                $item->qr_code = $item->public_uuid;
                // $item->qr_code = route('asset.public', $item->public_uuid);
            }

            // Generate file QR
            $item->generateQr();
        });
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

    public function pic()
    {
        return $this->belongsTo(User::class, 'pic_id');
    }
}
