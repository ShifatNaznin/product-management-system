<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Repositories\Color\ColorInterface;
use Illuminate\Http\Request;

class ColorController extends Controller
{ 
    private $color;

    public function __construct(ColorInterface $color)
    {
        $this->color = $color;
    }
    public function index()
    {
        $color = $this->color->index();
        return array_reverse($color);
    }
    // add color
    public function store(Request $request)
    {
        $request->validate([
            'colorName' => 'required',
        ]);
        $data = $request->all();
        $response = $this->color->store($data);
        return response()->json($response);
    }
}
