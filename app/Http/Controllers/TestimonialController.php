<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Testimonial.testimonial-list',[
            'testimonials'=>Testimonial::latest()->simplePaginate(5,['*'],'list'),
            'testimonialCount'=>Testimonial::count(),
            'testimonialTrashes'=>Testimonial::onlyTrashed()->simplePaginate(),
            'testTrashCount'=>Testimonial::onlyTrashed()->count(),
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
        $testimonial = new Testimonial;
        $testimonial->message=$request->message;
        $testimonial->c_name=$request->c_name;
        $testimonial->c_position=$request->c_position;
        $testimonial->save();
        if ($request->hasFile('c_image')) {
            $image = $request->file('c_image');
            $file_name = $testimonial->id.'_'.$testimonial->c_name.'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('testimonial/'.$file_name));
            $testimonial->c_image=$file_name;
            $testimonial->save();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial){
        return view('Backend.Testimonial.testimonial-edit',[
            'testimonialEdit'=>$testimonial,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial){
        $testimonial->message=$request->message;
        $testimonial->c_name=$request->c_name;
        $testimonial->c_position=$request->c_position;
        $testimonial->save();
        if ($request->hasFile('c_image')) {
            $cImage = $request->file('c_image');
            $file_name=$testimonial->id.'_'.$testimonial->c_name.'.'.$cImage->getClientOriginalExtension();
            $oldPath=public_path('testimonial/'.$testimonial->c_image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            Image::make($cImage)->save(public_path('testimonial/'.$file_name));
            $testimonial->c_image=$file_name;
            $testimonial->save();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial){
        $testimonial->delete();
        return back();
    }

    // Resotre Testimonial

    function testimonialRestore($id){
        Testimonial::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }
    
    // Permanent Delete

    function testimonialPermanentDelete($id){
        Testimonial::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }
}
