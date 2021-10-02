<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Product;

class subCategory extends Model
{
    use HasFactory,SoftDeletes;

    public function setsubCategoryNameAttribute($value){
        $this->attributes['subcategory_name'] = $value;
        $this->attributes['slug'] = $this->slugify($value);
    }

    private function slugify($value){
        return str_replace(' ','-',strtolower($value));
    }
    function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function product(){
        return $this->hasMany(Product::class,'subcategory_id');
    }
}
