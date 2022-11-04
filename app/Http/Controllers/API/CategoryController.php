<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function category()
    {
        $category = Category::all()->toArray();
        return array_reverse($category);
    }
}
