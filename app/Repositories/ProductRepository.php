<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all(array $data): LengthAwarePaginator
    {
        $products = $this->product->query();

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

    public function find(int $id): ?Product
    {
        return $this->product->find($id);
    }

    public function create(array $productData): Product
    {
        return $this->product->create($productData);
    }

    public function destroy(int $id): int
    {
        return $this->product->destroy($id);
    }
}
