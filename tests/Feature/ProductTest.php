<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateProduct()
    {
        $productData = [
            'name' => 'some name',
            'description' => 'product description',
            'price' => 99.99,
            'image' => 'path/to/image.jpg',
        ];


        $response = $this->post('/api/products', $productData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('products', $productData);
    }
}
