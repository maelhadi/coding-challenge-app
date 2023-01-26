<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function all()
    {
        return Product::query()->paginate(5);
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
