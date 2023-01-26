<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function all()
    {
        return Category::all();
    }

    public function find($id)
    {
        return Category::find($id);
    }

    public function create($categoryData)
    {
        return Category::create($categoryData);
    }

    public function destroy($id)
    {
        Category::destroy($id);
    }
}
