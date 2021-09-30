<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Color.color',[
            'colors'=>Color::latest()->simplePaginate(3,['*'],'color'),
            'colorCount'=>Color::count(),
            'colorTrashCount'=>Color::onlyTrashed()->count(),
            'colorTrashes'=>Color::onlyTrashed()->simplePaginate(3,['*'],'trash'),
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
            'color_name'=>['required','unique:colors,color_name']
        ],[
           'color_name.required'=>'Enter Color Name', 
           'color_name.unique'=>'Color Already Exists', 
        ]);
        $color = new Color;
        $color->color_name=$request->color_name;
        $color->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color){
        return view('Backend.Color.color-edit',[
            'colorEdit'=>$color,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color){
        $request->validate([
            'color_name'=>['required','unique:colors,color_name']
        ],[
            'color_name.required'=>'Enter Color Name',
            'color_name.unique'=>'Color Already Exists',
        ]);
        $color->color_name=$request->color_name;
        $color->save();
        return redirect()->route('color.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color){
        $color->delete();
        return back();
    }
    // Color Status
    function colorStatus($id){
        $colorStatus = Color::findOrFail($id);
        if ($colorStatus->status==1) {
            $colorStatus->status=2;
            $colorStatus->save();
        }
        else{
            $colorStatus->status=1;
            $colorStatus->save();
        }
        return back();
    }

    // Color Restore
    function colorRestore($id){
        Color::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }

    //Color Permanent Delete
    function colorPerDelete($id){
        Color::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    } 
}
