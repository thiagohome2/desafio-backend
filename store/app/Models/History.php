<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'client_id', 'order_id', 'card_number', 'value', 'date'
    ];
    public $timestamps = false;
    public function transaction()
    {
    	return $this->belongsTo('App\Models\Transaction');
    }
}
