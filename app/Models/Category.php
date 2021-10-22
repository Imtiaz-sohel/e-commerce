<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\subCategory;
use App\Models\Product;


class Category extends Model
{
    use HasFactory, SoftDeletes ;

    public function setcategoryNameAttribute($value){
        $this->attributes['category_name']=$value;
        $this->attributes['slug']=$this->slugify($value);
    }

    private function slugify($value){
        return str_replace(' ','-',strtolower($value));
    }

    function subcategory(){
        return $this->hasMany(subCategory::class,'category_id');
    }
    function product(){
        return $this->hasMany(Product::class,'category_id');
    }
    function blog(){
        return $this->hasMany(Blog::class,'category_id');
    }
}
