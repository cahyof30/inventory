<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemScanLog extends Model
{
    use HasFactory;

    protected $table = 'item_scan_logs';

    protected $fillable = [
        'item_id',
        'ip',
        'user_agent',
        'scanned_at',
    ];

    public $timestamps = true;
}
