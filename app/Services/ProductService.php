<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;
    private $categoryService;

    public function __construct(ProductRepository $productRepository, CategoryService $categoryService)
    {
        $this->productRepository = $productRepository;
        $this->categoryService = $categoryService;
    }

    public function getProducts($data)
    {
        return $this->productRepository->all($data);
    }

    public function createProduct($productData)
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

    public function destroyProduct($id)
    {
        $this->productRepository->destroy($id);
    }
}
