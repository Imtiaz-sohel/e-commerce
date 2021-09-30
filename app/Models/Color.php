<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
