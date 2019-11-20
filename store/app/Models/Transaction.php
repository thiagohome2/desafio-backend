<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'client_id', 'client_name', 'value_to_pay', 'card_number'
    ];
    public $timestamps = false;
    public function history()
    {
        return $this->hasOne('App\Models\History');
    }
    public function creditCard()
    {
    	return $this->hasOne('App\Models\CreditCard');
    }
}
