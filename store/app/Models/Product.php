<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_id', 'title','artist', 'year' ,'director','album', 'price', 'store', 'thumb', 'date'
    ];
    public $timestamps = false;
    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }
}
