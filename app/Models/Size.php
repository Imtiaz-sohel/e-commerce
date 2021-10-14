<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductAttribute;
use App\Models\Cart;

class Size extends Model
{
    use HasFactory, SoftDeletes;

    public function setsizeNameAttribute($value){
        $this->attributes['size_name']=$value;
        $this->attributes['slug']=$this->slugify($value);
    }

    private function slugify($value){
        return str_replace(' ','-',strtolower($value));
    }

    function productAttribute(){
        return $this->hasMany(ProductAttribute::class,'size_id');
    }

    function cart(){
        return $this->hasMany(Cart::class,'size_id');
    }
}
