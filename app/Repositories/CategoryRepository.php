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

    public function all()
    {
        return $this->category->all();
    }

    public function find($id)
    {
        return $this->category->find($id);
    }

    public function create($categoryData)
    {
        return $this->category->create($categoryData);
    }

    public function destroy($id)
    {
        $this->category->destroy($id);
    }
}
