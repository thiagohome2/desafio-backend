<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function __construct(Product $product)
	{
		$this->product = $product;
	}
    public function index()
    {
        $products = $this->product->all();
        return response()->json($products);
    }

    public function create(Request $request)
    {

    }

    public function show($id)
    {

    }
}
