<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['categoryName'];
    public function index()
    {
        $category = Category::all()->toArray();
        return $category;
    }
    public function store($data)
    {
        $input = $data;
        Category::create($input);
        $response = [
            'success' => 'Category created successfully'
        ];
        return $response;
    }
}
