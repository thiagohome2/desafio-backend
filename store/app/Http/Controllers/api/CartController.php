<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

use Validator;

class CartController extends Controller
{

    public function __construct(Cart $cart)
	{
		$this->cart = $cart;
    }
    public function store(Request $request)
    {
        $objectpost = $request->post();
        //d2eda25e-9757-11e9-bc42-526af7764f64
        $rules = [
            'cart_id' =>  'required|regex:/^([A-Za-z0-9]{8})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{12})/u|size:36',
            'client_id'=>  'required|regex:/^([A-Za-z0-9]{8})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{12})/u|size:36',
            'product_id'=>  'required|regex:/^([A-Za-z0-9]{8})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{12})/u|size:36',
            'date'=> 'required',
            'time'=> 'required'
        ];
        $messages = [
            'required' => 'O :attribute é um campo requerido.',
            'regex' => 'O formato do campo :attribute é inválido no quesito padrão.',
            'size' => 'O formato do campo :attribute é inválido no quesito tamanho.'
        ];

        $validator = Validator::make($objectpost, $rules, $messages);
        if ($validator->passes()) {

            if (!Product::where('product_id', $objectpost['product_id'])->exists()) {
                return response()->json(['data' => ['message' => 'Produto não encontrado!']], 204);
            }

            if (Cart::where('cart_id', $objectpost['cart_id'])->where('product_id', $objectpost['product_id'])->exists()) {
                return response()->json(['data' => ['message' => 'O produto ja está no carrinho!']], 400);
            }

            $cart = new Cart($objectpost);

            if (!$cart->save()) {
                return response()->json(['data' => ['message' => 'Ocorreu um problema no salvamento!']], 503);
            }
            return response()->json(['data' => ['message' => 'Produto adicionado ao carrinho.']], 201);
        } else {
            return response()->json(['data' => $validator->errors()->all()], 422);
        }
    }

}
