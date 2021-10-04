<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Banner.banner-list',[
            'banners'=>Banner::latest()->simplePaginate(),
            'bannerCount'=>Banner::latest()->count(),
            'bannerTrashes'=>Banner::onlyTrashed()->simplePaginate(),
            'bannerTrasheCount'=>Banner::onlyTrashed()->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
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
            'title'=>['required','unique:banners,title'],
            'description'=>['required'],
            'image'=>['required'],
        ],[
            'title.required'=>'Enter Title',
            'description.required'=>'Enter Description',
            'image.required'=>'Enter Image',            
        ]);
        $banner = new Banner;
        $banner->title=$request->title;
        $banner->description=$request->description;
        $banner->save();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $banner->id.'_'.$banner->title.'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('banner/'.$file_name));
            $banner->image=$file_name;
            $banner->save();
        }
        return back();      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner){
        return view('Backend.Banner.banner-edit',[
            'bannerEdit'=>$banner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner){
        $banner->title=$request->title;
        $banner->description=$request->description;
        $banner->save();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $banner->id.'_'.$banner->title.'.'.$image->getClientOriginalExtension();
            $oldPath = public_path('banner/'.$banner->image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            Image::make($image)->save(public_path('banner/'.$file_name));
            $banner->image=$file_name;
            $banner->save();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner){
        $banner->delete();
        return back();
    }

    // Banner Status
    function bannerStatus($id){
        $banner = Banner::findOrFail($id);
        if ($banner->status==1) {
            $banner->status=2;
            $banner->save();
        }
        else{
            $banner->status=1;
            $banner->save();
        }
        return back();
    }

    // Banner Restore
    function bannerRestore($id){
        Banner::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }

    // Banner Permanent Delete

    function bannerPerDelete($id){
        Banner::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }


















}
