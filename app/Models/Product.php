<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\subCategory;
use App\Models\Brand;
use App\Models\ProductGallery;
use App\Models\ProductAttribute;
use App\Models\Cart;
use App\Models\Wishlist;


class Product extends Model
{
    use HasFactory,SoftDeletes;

    public function setProductTitleAttribute($value){
        $this->attributes['product_title']=$value;
        $this->attributes['slug']=$this->slugify($value);
    }

    private function slugify($value){
        return str_replace(' ','-',strtolower($value));
    }

    function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function subcategory(){
        return $this->belongsTo(subCategory::class,'subcategory_id');
    }
    function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }
    function productGallery(){
        return $this->hasMany(ProductGallery::class,'product_id');
    }
    function productAttribute(){
        return $this->hasMany(ProductAttribute::class,'product_id');
    }
    function cart(){
        return $this->hasMany(Cart::class,'product_id');
    }
    function wishlist(){
        return $this->hasMany(Wishlist::class,'product_id');
    }
}
