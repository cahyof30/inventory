<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
    ];
    public $timestamps = true;

    public function locations()
    {
        return $this->hasMany(Location::class, 'location_category_id');
    }
}
