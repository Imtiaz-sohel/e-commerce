<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogcommentController extends Controller{
    function blogComment(Request $request){
        $request->validate([
            'name'=>['required'],
            'email'=>['required'],
            'message'=>['required','unique:blog_comments,message'],
        ],[
            'name.required'=>'Enter Name',
            'email.required'=>'Enter Email',
            'message.required'=>'Enter Message',            
        ]);
        $blogComments = new BlogComment;
        $blogComments->user_id=Auth::id();
        $blogComments->blog_id=$request->blog_id;
        $blogComments->name=$request->name;
        $blogComments->email=$request->email;
        $blogComments->message=$request->message;
        $blogComments->save();
        return back();
    }
}
