<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories(): array
    {
        return $this->categoryRepository->all();
    }

    public function findCategory(int $id): Category
    {
        return $this->categoryRepository->find($id);
    }

    public function createCategory(array $categoryData): Category
    {
        return $this->categoryRepository->create($categoryData);
    }

    public function destroyCategory(int $id): int
    {
        return $this->categoryRepository->destroy($id);
    }
}
