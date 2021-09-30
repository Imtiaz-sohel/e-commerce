<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Brand.brand-list',[
            'brands'=>Brand::latest()->simplePaginate(5,['*'],'brand'),
             'brandCount'=>Brand::count(),
             'brandTrashes'=>Brand::onlyTrashed()->simplePaginate(2,['*'],'trash'),
             'trashCount'=>Brand::onlyTrashed()->count(),
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
           'brand_name'=>['required','unique:brands,brand_name'] 
        ],[
            'brand_name.required'=>'Enter Brand Name',
            'brand_name.unique'=>'Brand Name Already Exists',
        ]);
        $brand = new Brand;
        $brand->brand_name=$request->brand_name;
        $brand->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand){
        return view('Backend.Brand.brand-edit',[
            'brandEdit'=>$brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand){
        $request->validate([
            'brand_name'=>['required','unique:brands,brand_name']
        ],[
            'brand_name.required'=>'Enter Brand Name',
            'brand_name.unique'=>'Brand Name Already Exists',
        ]);
        $brand->brand_name=$request->brand_name;
        $brand->save();
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand){
        $brand->delete();
        return back();
    }

   //Brand Status
   function brandStatus($id){
       $brand = Brand::findOrFail($id);
       if ($brand->status==1) {
           $brand->status=2;
           $brand->save();
       }
       else{
           $brand->status=1;
           $brand->save();
       }
       return back();
   }
    //Brand Restore  
    function brandRestore($id){
        Brand::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }
    // Brand Permanent Delete
    function brandPermanent($id){
        Brand::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }
}
