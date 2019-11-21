<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{

    public function testCreateProduct()
    {
        $data = [
            "product_id" => "d2eda25e-9757-11e9-bc42-526af7764f64",
            "artist" => "Pink Floyd",
            "year" => 1973,
            "album" => "Dask Side of The Moon",
            "price" => 250,
            "store" => "Minha Loja de Discos",
            "thumb" => "https://images-na.ssl-images-amazon.com/images/I/61R7gJadP7L._SX355_.jpg",
            "date" => "26/11/2018"
          ];

          $post = $this->post('/store/api/v1/product', $data);

          $post->assertJson(json_encode([
            'message' => 'Produto Adicionado.'
          ]));

          $post->assertResponseStatus(201);
    }

    public function testGetProducts()
    {
        $response = $this->get('/store/api/v1/products');

        $response->assertStatus(200);
    }
}
