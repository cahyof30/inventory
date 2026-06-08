<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
        use HasFactory;

    protected $fillable = [
         'location_id',
          'code',
          'name',
          'description',
    ];

    public $timestamps = true;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
