<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Product\ProductInterface;

class ProductRepository implements ProductInterface
{
    public $product;

    function __construct(Product $product) {
	    $this->product = $product;
    }
    public function index()
    {
        return $this->product->index();
    }
    public function productStore($data,$images)
    {
        return $this->product->productStore($data,$images);
    }
    public function productEdit($id)
    {
        return $this->product->productEdit($id);
    }
    public function productUpdate($id,$data,$images)
    {
        return $this->product->productUpdate($id,$data,$images);
    }
    public function singleProduct($slug)
    {
        return $this->product->singleProduct($slug);
    }
    public function deleteProduct($id)
    {
        return $this->product->deleteProduct($id);
    }
}