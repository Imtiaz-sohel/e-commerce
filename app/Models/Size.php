<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
