<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Keywords;
use App\Models\User;

class Blog extends Model
{
    use HasFactory,SoftDeletes;

    public function setBlogTitleAttribute($value){
         $this->attributes['blog_title']=$value;
         $this->attributes['slug']=$this->slugify($value);
    }

    private function slugify($value){
        return str_replace(' ','-',strtolower($value));
    }

    function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function keyword(){
        return $this->hasMany(Keywords::class,'blog_id');
    }
    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
