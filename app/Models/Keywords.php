<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Blog;

class Keywords extends Model
{
    use HasFactory,SoftDeletes;

    function blog(){
        return $this->belongsTo(Blog::class,'blog_id');
    }
}
