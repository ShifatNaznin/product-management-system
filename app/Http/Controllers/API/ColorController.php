<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Color;

class ColorController extends Controller
{ 
    public function color()
    {
        $category = Color::all()->toArray();
        return array_reverse($category);
    }
}
