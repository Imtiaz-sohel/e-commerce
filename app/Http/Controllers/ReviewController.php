<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Keywords;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller{
    function ReviewPost(Request $request){
        $request->validate([
            'message'=>['required'],
            'ratting'=>['required'],
        ],[
            'message.required'=>'Please Enter Your Review',
            'ratting.required'=>'Please Give Ratting',
        ]);
        $review = new Review;
        $review->user_id=Auth::id();
        $review->product_id=$request->product_id;
        $review->name=$request->name;
        $review->email=$request->email;
        $review->message=$request->message;
        $review->ratting=$request->ratting;        
        $review->save();
        $notification=array(
            'message'=>'Review Added Sucessfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }

    // faq

    function faq(){
        return view('Frontend.faq',[
            'faqs'=>Faq::latest()->get(),
            'faqId' => Faq::latest()->first()->id,
        ]);

    }

    // Blog

    function blogView(){
        return view('Frontend.blog',[
            'blogs'=>Blog::with('User')->latest()->paginate(3),
        ]);
    }

    function singleBlog($slug){
        Blog::where('slug',$slug)->first()->increment('views');
        $blog=Blog::with('user')->where('slug',$slug)->first();
        return view('Frontend.blog-details',[
            'blog'=>$blog,
            'categories'=>Category::with('blog')->get(),
            'lBlogs'=>Blog::latest()->take(4)->get(),
            'blogComments'=>BlogComment::where('blog_id',$blog->id)->latest()->get(),
            'blogCommentCount'=>BlogComment::where('blog_id',$blog->id)->count(),
        ]);
    }

    function blogByCategory($id){
        return view('Frontend.blog-by-category',[
            'blogs'=>Blog::with(['category'])->where('category_id',$id)->paginate(3),
        ]);
    }
}
