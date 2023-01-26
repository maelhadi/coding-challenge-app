<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts()
    {
        return $this->productRepository->all();
    }

    public function createProduct($productData)
    {
        return $this->productRepository->create($productData);
    }

    public function destroyProduct($id)
    {
        $this->productRepository->destroy($id);
    }
}
