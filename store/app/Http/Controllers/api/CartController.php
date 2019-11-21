<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{

    public function __construct(Cart $cart)
	{
		$this->cart = $cart;
    }
    public function store(Request $request)
    {
        $objectpost = $request->post();

        if (!Product::where('product_id', $objectpost['product_id'])->exists()) {
            return response()->json(['data' => ['message' => 'Produto não encontrado!']], 503);
        }

        if (Cart::where('cart_id', $objectpost['cart_id'])->where('product_id', $objectpost['product_id'])->exists()) {
            return response()->json(['data' => ['message' => 'O produto ja está no carrinho!']], 503);
        }

        $cart = new Cart($objectpost);

        if (!$cart->save()) {
            return response()->json(['data' => ['message' => 'Ocorreu um problema no salvamento!']], 503);
        }
        return response()->json(['data' => ['message' => 'Produto adicionado ao carrinho.']], 201);

    }

}
