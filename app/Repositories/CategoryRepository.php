<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all(): array
    {
        return $this->category->all()->toArray();
    }

    public function find(int $id): ?Category
    {
        return $this->category->find($id);
    }

    public function create(array $categoryData): Category
    {
        return $this->category->create($categoryData);
    }

    public function destroy(int $id): int
    {
        return $this->category->destroy($id);
    }
}
