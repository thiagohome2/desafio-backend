<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use Validator;

class ProductController extends Controller
{
    public function all()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function create(Request $request)
    {
        $objectpost = $request->post();

        $rules = [
            'product_id' => 'required|regex:/^([A-Za-z0-9]{8})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{12})/u|size:36',
            'price'=> 'required|integer',
            'store'=> 'required',
            'thumb'=> 'required|url',
            'date'=> 'required'
        ];

        $messages = [
            'required' => 'O :attribute é um campo requerido.',
            'integer' => 'O :attribute é um campo inteiro.',
            'url' => 'O :attribute é um campo tipo url.',
            'unique' => 'O :attribute é um campo inteiro.',
            'regex' => 'O formato do campo :attribute é inválido no quesito padrão.',
            'size' => 'O formato do campo :attribute é inválido no quesito tamanho.'
        ];

        $validator = Validator::make($objectpost, $rules, $messages);
        if ($validator->passes()) {

            if (Product::where('product_id', $objectpost['product_id'])->exists()) {
                return response()->json(['data' => ['message' => 'Produto cadastrado!']], 412);
            }

            $product = new Product($objectpost);

            if (!$product->save()) {
                return response()->json(['data' => ['message' => 'Houve um erro ao criar o produto.']], 503);
            }
            return response()->json(['data' => ['message' => 'Produto cadastrado com sucesso.']], 201);
        } else {
            return response()->json(['data' => $validator->errors()->all()], 422);
        }

    }
}
