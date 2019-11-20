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


Route::post('product', function()
{
    return 'opaaaa! roa de produto ok';
});
Route::get('products', function()
{
    return 'opaaaa! roa de produtos ok';
});
Route::post('add_to_cart', function()
{
    return 'opaaaa! roa de add_to_cart ok';
});
Route::post('buy', function()
{
    return 'opaaaa! roa de  buy ok';
});
Route::get('history', function()
{
    return 'opaaaa! roa de  history ok';
});
Route::get('history/{client_id}', function()
{
    return 'opaaaa! roa de  history{client_id} ok';
});
