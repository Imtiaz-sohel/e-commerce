<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductAttribute;

class Color extends Model
{
    use HasFactory,SoftDeletes;

    public function setColorNameAttribute($value){
        $this->attributes['color_name'] = $value;
        $this->attributes['slug'] = $this->slugify($value);
    }

    private function slugify($value){
        return str_replace(' ','-',strtolower($value));
    }
    function productAttribute(){
        return $this->hasMany(ProductAttribute::class,'color_id');
    }
}
