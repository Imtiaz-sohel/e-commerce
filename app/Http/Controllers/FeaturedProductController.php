<?php

namespace App\Http\Controllers;

use App\Models\FeaturedProduct;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FeaturedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Featured Product.featured-product-list',[
            'FeaturedProducts'=>FeaturedProduct::latest()->simplePaginate(4,['*'],'list'),
            'FeaturedProductCount'=>FeaturedProduct::count(),
            'featureTrashes'=>FeaturedProduct::onlyTrashed()->simplePaginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
           'product_title'=>['required','unique:featured_products,product_title'],
           'product_image'=>['required'],   
        ],[
            'product_title.required'=>'Enter Title',
            'product_title.unique'=>'Title Already Exists',
            'product_image.required'=>'Enter Image',            
        ]);
        $featuredProduct = new FeaturedProduct;
        $featuredProduct->product_title=$request->product_title;
        $featuredProduct->save();
        if ($request->hasFile('product_image')) {
           $image = $request->file('product_image');
           $file_name = $featuredProduct->id.'_'.$featuredProduct->product_title.'.'.$image->getClientOriginalExtension();
           Image::make($image)->save(public_path('Featured_Image/'.$file_name));
           $featuredProduct->product_image=$file_name;
           $featuredProduct->save();
        }
        $notification=array(
            'message'=>'Feature Product Insert Successfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeaturedProduct  $featuredProduct
     * @return \Illuminate\Http\Response
     */
    public function show(FeaturedProduct $featuredProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeaturedProduct  $featuredProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(FeaturedProduct $featuredProduct){
        return view('Backend.Featured Product.featured-product-edit',[
            'featuredProductEdit'=>$featuredProduct,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeaturedProduct  $featuredProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeaturedProduct $featuredProduct){
        $request->validate([
            'product_title'=>['required'],
            'product_image'=>['required'],   
        ],[
            'product_title.required'=>'Enter Title',
            'product_image.required'=>'Enter Image', 
        ]);
        $featuredProduct->product_title=$request->product_title;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $file_name=$featuredProduct->id.'_'.$featuredProduct->product_title.'.'.$image->getClientOriginalExtension();
            $oldPath=public_path('Featured_Image/'.$featuredProduct->product_image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            Image::make($image)->save(public_path('Featured_Image/'.$file_name));
            $featuredProduct->product_image=$file_name;
            $featuredProduct->save();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeaturedProduct  $featuredProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeaturedProduct $featuredProduct){
        $featuredProduct->delete();
        return back();
    }
    // Featured Product Restore
    function featuredRestore($id){
        FeaturedProduct::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }

    // Featured Product Permanent Delete
    function featuredPerDelete($id){
        FeaturedProduct::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }
}


