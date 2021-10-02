<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Brand extends Model
{
    use HasFactory,SoftDeletes;
    
    public function setBrandNameAttribute($value){
        $this->attributes['brand_name']=$value;
        $this->attributes['slug']=$this->slugify($value);
    }

    private function slugify($value){
        return str_replace(' ','-',strtolower($value));
    }

    function product(){
        return $this->hasMany(Product::class,'brand_id');
    }
}
