<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_id',
        'user_id',
        'condition_on_return',
    ];
    public $timestamps = true;

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
