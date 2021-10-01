<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Product.product-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('Backend.Product.product-add',[
            'categories'=>Category::all(),
            'brands'=>Brand::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $product = new Product;
        $product->product_title=$request->product_title;
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->brand_id=$request->brand_id;
        $product->summary=$request->summary;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->save();
        // Thumbnail Insert
        if ($request->hasFile('thumbnail')) {
            $thumbnail=$request->thumbnail;
            $product = Product::findOrFail($product->id);
            $file_name = $product->id.'.'.$product->product_title.'.'.$thumbnail-> getClientOriginalExtension();
            Image::make($thumbnail)->save(public_path('product/thumbnail/'.$file_name));
            $product->thumbnail=$file_name;
            $product->save();
        }
        // Product Gallery Insert
        // work here
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    function getSubCategory($cat_id){
        $subCategory = subCategory::where('category_id',$cat_id)->get();
        return response()->json($subCategory);
    }





















}
