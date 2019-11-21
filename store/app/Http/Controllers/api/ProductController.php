<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

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

        if (Product::where('product_id', $objectpost['product_id'])->exists()) {
            return response()->json(['data' => ['message' => 'Produto cadastrado.']], 412);
        }

        $product = new Product($objectpost);

        if (!$product->save()) {
            return response()->json(['data' => ['message' => 'Houve um erro ao criar o produto.']], 412);
        }
        return response()->json(['data' => ['message' => 'Produto cadastrado com sucesso.']], 201);
    }
}
