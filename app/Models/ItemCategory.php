<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
  use HasFactory;
  protected $table = 'item_categories';
    protected $fillable = [
        'slug',
        'code',
        'name',
    ];
    public $timestamps = true;
}
