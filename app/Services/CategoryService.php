<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories()
    {
        return $this->categoryRepository->all();
    }

    public function createCategory($categoryData)
    {
        return $this->categoryRepository->create($categoryData);
    }

    public function destroyCategory($id)
    {
        $this->categoryRepository->destroy($id);
    }
}
