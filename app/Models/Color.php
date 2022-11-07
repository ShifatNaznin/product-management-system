<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['colorName'];
    public function index()
    {
        $color = Color::all()->toArray();
        return $color;
    }
    public function store($data)
    {
        $input = $data;
        Color::create($input);
        $response = [
            'success' => 'Color created successfully'
        ];
        return $response;
    }
}
