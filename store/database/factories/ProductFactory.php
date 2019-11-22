<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

function criatecode()
{
    $rand = mt_rand(0, 32);
    $code = md5($rand . time());
    return substr($code,0,8).'-'.substr($code,8,4).'-'.substr($code,12,4).'-'.substr($code,16,4).'-'.substr($code,20,12);
}

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_id'=> trim(criatecode()),
        'title'=> $faker->catchPhrase,
        'year'=> $faker->year($max = 'now') ,
        'director'=> $faker->name,
        'price'=>$faker->buildingNumber,
        'store'=> $faker->company,
        'thumb'=> $faker->image,
        'date'=> date('d/m/Y')
    ];
});
