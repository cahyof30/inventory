<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
    ];
    public $timestamps = true;

    public function items()
    {
        return $this->hasMany(Item::class, 'location_id');
    }
}
