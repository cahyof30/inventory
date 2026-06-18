<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpBan extends Model
{
   protected $fillable = [
        'ip',
        'failed_attempts',
        'banned_until'
    ];
}
