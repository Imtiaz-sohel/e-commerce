<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Keywords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Blog.blog',[
            'blogs'=>Blog::with('category')->latest()->simplePaginate(),
            'blogCount'=>Blog::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('Backend.Blog.blog-add',[
            'categories'=>Category::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
       $request->validate([
        'category_id'=>['required'],
        'blog_title'=>['required','unique:blogs,blog_title'],
        'description'=>['required'],
        'thumbnail'=>['required'],
        'featured_image'=>['required'],           
        'keywords'=>['required'],           
       ],[
        'category_id.required'=>'Select Category',
        'blog_title.required'=>'Enter Blog Title',
        'blog_title.unique'=>'Blog Title Already Exists',
        'description.required'=>'Enter Blog Description',
        'thumbnail.required'=>'Enter Blog Thumbnail',
        'featured_image.required'=>'Enter Blog Featured Image',
        'keywords.required'=>'Enter Tag',
       ]);
       $blog = new Blog;
       $blog->user_id=Auth::id();
       $blog->category_id=$request->category_id;
       $blog->blog_title=$request->blog_title;
       $blog->description=$request->description;
       $blog->save();
       if ($request->hasFile('thumbnail')) {
           $thumbnail = $request->file('thumbnail');
           $fileName=$blog->id.'_'.$blog->slug.'.'.$thumbnail->getClientOriginalExtension();
           Image::make($thumbnail)->save(public_path('Blog_Image/Thumbnail/'.$fileName));
           $blog->thumbnail=$fileName;
           $blog->save();    
       }
       if ($request->hasFile('featured_image')) {
          $featuredImage = $request->file('featured_image');
          $fileName = $blog->id.'_'.$blog->slug.'.'.$featuredImage->getClientOriginalExtension();
          Image::make($featuredImage)->save(public_path('Blog_Image/Featured_Image/'.$fileName));
          $blog->featured_image=$fileName;
          $blog->save();
       }

       $keywords = $request->keywords;
       foreach ($keywords as $key => $keyword) {
          $key = new Keywords;
          $key->blog_id=$blog->id;
          $key->keywords=$keyword;
          $key->save();
       }
       $notification=array(
           'message'=>'Blog Inserted Successfully',
           'alert-type'=>'success',
       );
       return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog){
        return view('Backend.Blog.blog-edit',[
            'blogEdit'=>$blog,
            'categories'=>Category::latest()->get(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog){
    $request->validate([
        'category_id'=>['required'],
        'description'=>['required'],
        'thumbnail'=>['required'],
        'featured_image'=>['required'],           
        ],[
        'category_id.required'=>'Select Category',
        'blog_title.required'=>'Enter Blog Title',
        'description.required'=>'Enter Blog Description',
        'thumbnail.required'=>'Enter Blog Thumbnail',
        'featured_image.required'=>'Enter Blog Featured Image',
        ]);
        $blog->user_id=Auth::id();
        $blog->category_id=$request->category_id;
        $blog->blog_title=$request->blog_title;
        $blog->description=$request->description;
        $blog->save();
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $fileName = $blog->id.'_'.$blog->slug.'.'.$thumbnail->getClientOriginalExtension();
            $oldPath=public_path('Blog_Image/Thumbnail/'.$blog->thumbnail);
            if (file_exists($oldPath)) {
               unlink($oldPath);
            }
            Image::make($thumbnail)->save(public_path('Blog_Image/Thumbnail/'.$fileName));
            $blog->thumbnail=$fileName;
            $blog->save();
        }
        if ($request->hasFile('featured_image')) {
           $featuredImage = $request->file('featured_image');
           $fileName = $blog->id.'_'.$blog->slug.'.'.$featuredImage->getClientOriginalExtension();
           $oldPath = public_path('Blog_Image/Featured_Image/'.$blog->featured_image);  
           if (file_exists($oldPath)) {
               unlink($oldPath);
           }
           Image::make($featuredImage)->save(public_path('Blog_Image/Featured_Image/'.$fileName));
           $blog->featured_image=$fileName;
           $blog->save();
        }
        $notification=array(
            'message'=>'Blog Updated Successfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog){
        $blog->delete();
        Keywords::where('blog_id',$blog->id)->delete();
        $notification=array(
            'message'=>'Blog Moved To Trashed',
            'alert-type'=>'warning',
        );
        return back()->with($notification);
    }

    function blogTrash(){
        return view('Backend.Blog.blog-trash',[
            'blogTrashes'=>Blog::onlyTrashed()->simplePaginate(),
            'blogTrashCount'=>Blog::onlyTrashed()->count(),
        ]);
    }

    function blogDelete($id){
       Blog::onlyTrashed()->findOrFail($id)->forceDelete();
       Keywords::onlyTrashed()->where('blog_id',$id)->forceDelete();
        $notification=array(
            'message'=>'Blog Deleted Permanently',
            'alert-type'=>'warning',
        );
        return back()->with($notification);
    }

    function blogRestore($id){
        Blog::onlyTrashed()->findOrFail($id)->restore();
        Keywords::onlyTrashed()->where('blog_id',$id)->restore();
        $notification=array(
            'message'=>'Blog Restored Successfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }

    function blogStatus($id){
        $blog = Blog::where('id',$id)->first();
        if ($blog->status==1) {
            $blog->status=2;
            $blog->save();
        }
        else{
            $blog->status=1;
            $blog->save();
        }
        return back();
    }
}
