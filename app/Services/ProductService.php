<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    private $productRepository;
    private $categoryService;

    public function __construct(ProductRepository $productRepository, CategoryService $categoryService)
    {
        $this->productRepository = $productRepository;
        $this->categoryService = $categoryService;
    }

    public function getProducts(array $data): LengthAwarePaginator
    {
        return $this->productRepository->all($data);
    }

    public function createProduct(array $productData): Product
    {
        $product = $this->productRepository->create($productData);

        if (isset($productData['categories'])) {
            foreach ($productData['categories'] as $id) {
                $category = $this->categoryService->findCategory($id);
                $product->categories()->attach($category);
            }
        }

        return $product;
    }

    public function destroyProduct(int $id): int
    {
        return $this->productRepository->destroy($id);
    }
}
