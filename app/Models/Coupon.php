<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    
    public function setCouponNameAttribute($value){
        $this->attributes['coupon_name']=$value;
        $this->attributes['slug']=$this->slugify($value);
    }

    private function slugify($value){
        return str_replace(' ','-',strtolower($value));
    }
}
