<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;

class ProductRepository
{
    public function all($data)
    {
        $products = Product::query();

        if (isset($data['category'])) {
            $categoryId = $data['category'];
            $products->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }

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
        $product = Product::create($productData);

        if (isset($productData['categories'])) {
            foreach ($productData['categories'] as $id) {
                $category = Category::find($id);
                $product->categories()->attach($category);
            }
        }

        return $product;
    }

    public function destroy($id)
    {
        Product::destroy($id);
    }
}
