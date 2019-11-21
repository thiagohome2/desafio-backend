<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'cart_id', 'client_id', 'product_id', 'date', 'time'
    ];
    public $timestamps = false;
}
