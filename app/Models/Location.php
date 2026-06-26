<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'location_category_id',
        'slug',
        'name',
    ];  
    public $timestamps = true;

    public function items()
    {
        return $this->hasMany(Item::class, 'location_id');
    }

    public function locationCategory()
    {
        return $this->belongsTo(LocationCategory::class, 'location_category_id');
    }
}
