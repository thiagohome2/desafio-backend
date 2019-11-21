<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'client_id', 'client_name', 'total_to_pay', 'credit_card'
    ];
    public $timestamps = false;
}
