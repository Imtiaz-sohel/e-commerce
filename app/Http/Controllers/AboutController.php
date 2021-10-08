<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.About.about-us',[
            'abouts'=>About::latest()->simplePaginate(),
            'aboutCount'=>About::count(),
            'aboutTrashes'=>About::onlyTrashed()->simplePaginate(),
            'aboutTrashCount'=>About::onlyTrashed()->count(),
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
            'about'=>['required'],
        ],[
            'about.required'=>'Write About To Honey',
        ]);
        $about = new About;
        $about->about=$request->about;
        $about->save();
        $nofification=array(
            'message'=>'About Us Inserted Successfully',
            'alert-type'=>'success',
        );
        return back()->with($nofification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about){
        return view('Backend.About.about-us-edit',[
            'aboutEdit'=>$about,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about){
        $request->validate([
            'about'=>['required'],
        ],[
            'about.required'=>'Write About To Honey',
        ]);
        $about->about=$request->about;
        $about->save();
        $nofification=array(
            'message'=>'About Us Update Successfully',
            'alert-type'=>"success",
        );
        return back()->with($nofification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about){
        $about->delete();
        $nofification=array(
            'message'=>'About Us Moved To Trashed',
            'alert-type'=>"warning",
        );
        return back()->with($nofification);
    }

    function aboutRestore($id){
        About::onlyTrashed()->findOrFail($id)->restore();
        $nofification=array(
            'message'=>'About Us Restored',
            'alert-type'=>"success",
        );
        return back()->with($nofification);
    }

    function aboutPerDelete($id){
        About::onlyTrashed()->findOrFail($id)->forceDelete();
        $nofification=array(
            'message'=>'About Us Permanently Deleted',
            'alert-type'=>"danger",
        );
        return back()->with($nofification);
    }
























}
