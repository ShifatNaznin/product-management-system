<?php

namespace App\Repositories\Color;

use App\Models\Color;
use App\Repositories\Color\ColorInterface;

class ColorRepository implements ColorInterface
{
    public $color;

    function __construct(Color $color) {
	    $this->color = $color;
    }
  
    public function index()
    {
        return $this->color->index();
    }
    public function store($data)
    {
        return $this->color->store($data);
    }
}