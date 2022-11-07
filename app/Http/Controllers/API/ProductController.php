<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }
    public function index()
    {
        $data = $this->product->index();
        return array_reverse($data);
    }
    // for product store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'categoryId' => 'required',
            'colorId' => 'required',
            'price' => 'required',
            'description' => 'required',
            'file' => 'required',
            'file.*' => 'required|image',
        ]);
        $data = $request->all();
        $images = array();
        if ($files = $request->file('file')) {
            foreach ($files as $file) {
                $destinationPath = 'img/';
                $name = $file->getClientOriginalName();
                $file->move($destinationPath, $name);
                $images[] = $name;
            }
        }
        $response = $this->product->productStore($data, $images);
        return response()->json($response);
    }
    // find product for edit
    public function edit($id)
    {
        $response = $this->product->productEdit($id);
        return response()->json($response);
    }
    // update product information
    public function update($id, Request $request)
    {
        $data = $request->all();
        if (!empty($request->file('file'))) {
            $images = array();
            if ($files = $request->file('file')) {
                foreach ($files as $file) {
                    $destinationPath = 'img/';
                    $name = $file->getClientOriginalName();
                    $file->move($destinationPath, $name);
                    $images[] = $name;
                }
            }
        } else {
            $images = 0;
        }
        $response = $this->product->productUpdate($id, $data, $images);
        return response()->json($response);
    }
    // for show product details
    public function singleProduct($slug)
    {
        $response = $this->product->singleProduct($slug);
        return response()->json($response);
    }
    // for delete product
    public function delete($id)
    {
        $response = $this->product->deleteProduct($id);
        return response()->json($response);
    }
}
