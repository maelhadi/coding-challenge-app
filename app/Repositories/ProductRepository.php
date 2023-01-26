<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function all($data)
    {
        $products = Product::query();

        if (isset($data['column']) && isset($data['order'])) {
            $products->orderBy($data['column'], $data['order']);
        }
        return $products->paginate(5);
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function create($productData)
    {
        return Product::create($productData);
    }

    public function destroy($id)
    {
        Product::destroy($id);
    }
}
