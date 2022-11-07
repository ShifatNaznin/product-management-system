<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Category\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        $category = $this->category->index();
        return array_reverse($category);
    }
    // add category
    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required',
        ]);
        $data = $request->all();
        $response = $this->category->store($data);
        return response()->json($response);
    }
}
