<?php 

namespace App\Repositories\Category;


interface CategoryInterface {
    public function index();
    public function store($data);
}