<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryInterface;

class CategoryRepository implements CategoryInterface
{
    public $category;

    function __construct(Category $category) {
	    $this->category = $category;
    }
  
    public function index()
    {
        return $this->category->index();
    }
    public function store($data)
    {
        return $this->category->store($data);
    }
}