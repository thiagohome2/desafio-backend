<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $fillable = ['card_number', 'card_holder_name', 'cvv', 'exp_date'];
    public $timestamps = false;
    public function transaction()
    {
    	return $this->belongsTo('App\Transaction');
    }
}
