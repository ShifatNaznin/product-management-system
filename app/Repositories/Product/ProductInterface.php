<?php 

namespace App\Repositories\Product;


interface ProductInterface {
    public function index();
    public function productStore($data,$images);
    public function productEdit($id);
    public function productUpdate($id,$data,$images);
    public function singleProduct($slug);
    public function deleteProduct($id);
}