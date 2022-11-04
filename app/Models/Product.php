<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $appends = ['categoryAll','colorAll'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function index()
    {
        $Product = Product::all()->toArray();
        return $Product;
    }
    public function productStore($request,$images)
    {
        $input = $request;
        $json_category = json_encode(explode(',',request()->categoryId));
        $json_color = json_encode(explode(',',request()->colorId));
   
        Product::insert([
            'image' =>  json_encode($images),
            'name' => $input['name'],
            'slug' => Str::slug($input['name'], '-'),
            'categoryId' =>$json_category,
            'colorId' => $json_color,
            'price' => $input['price'],
            'description' => $input['description'],
        ]);
        $response = [
            'success' => 'Product created successfully'
        ];
        return $response;
    }
    public function productEdit($id)
    {
        $response = Product::find($id);
        return $response;
    }
    public function productUpdate($id,$data,$images)
    {
        $input=$data;
        if(!empty(request()->categoryId)){
            $json_category = json_encode(explode(',',request()->categoryId));
        }else{
            $json_category=0;
        }
        if(!empty(request()->colorId)){
            $json_color = json_encode(explode(',',request()->colorId));
        }else{
            $json_color=0;
        }
     
        $post = Product::find($id);
        if($images== 0){
            $post->image =  $post->image;
        }else{
       $post->image = json_encode($images);
        }
        $post->name = $input['name'];
        $post->slug = Str::slug($input['name'], '-');
        if($json_category == 0){
            $post->categoryId =  $post->categoryId;
        }else{
            $post->categoryId =$json_category;
        }
        if($json_color == 0){
            $post->colorId = $post->colorId;
        }else{
            $post->colorId = $json_color;
        }
        $post->price = $input['price'];
        $post->description = $input['description'];
        if( $post->save() ) {
            $response = [
                'success' => 'Product created successfully'
            ];
            return $response;
        }
    }
    public function singleProduct($slug)
    {
        $data = Product::where('slug', $slug)->first();
        return $data;
    }
    public function deleteProduct($id)
    {
        $data = Product::find($id);
        $data->delete();
        return $data;
    }

    public function getCategoryAllattribute()
    {
        if (strlen($this->categoryId) && $this->categoryJson($this->categoryId)){
            $categor_list = [];
            foreach (json_decode($this->categoryId) as $id) {
                $categor_list[] = \App\Models\Category::where('id',$id)->first();
            }
            return $categor_list;
        }
        else{
            return [];
        }
    }

    function categoryJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
    public function getColorAllattribute()
    {
        if (strlen($this->categoryId) && $this->colorJson($this->categoryId)){
            $color_list = [];
            foreach (json_decode($this->categoryId) as $id) {
                $color_list[] = \App\Models\Color::where('id',$id)->first();
            }
            return $color_list;
        }
        else{
            return [];
        }
    }

    function colorJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
