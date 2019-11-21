<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('product', 'Api\ProductController@create');

Route::get('products', 'Api\ProductController@all');

Route::post('add_to_cart', 'Api\CartController@store');

Route::post('buy', 'Api\TransactionController@store');

Route::get('history', 'Api\HistoryController@all');

Route::get('history/{clientid}', 'Api\HistoryController@allbyid');
