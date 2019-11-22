<?php

namespace Tests\Feature;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testListProducts()
    {
        $products = factory(Product::class, 3)->create();

        $this->json('GET', 'store/api/v1/products')->assertStatus(200);

    }

}
