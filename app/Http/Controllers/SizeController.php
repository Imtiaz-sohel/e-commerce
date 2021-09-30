<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Size.size-list',[
            'sizes'=>Size::latest()->simplePaginate(3),
            'sizeCount'=>Size::count(),
            'sizeTrashes'=>Size::onlyTrashed()->simplePaginate(2),
            'sizeTrashCount'=>Size::onlyTrashed()->count(),
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
            'size_name'=>['required','unique:sizes,size_name'],
        ],[
           'size_name.required'=>'Enter Size Name',
           'size_name.unique'=>'Size Already Exists',
        ]);
        $size = new Size;
        $size->size_name=$request->size_name;
        $size->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size){
        return view('Backend.Size.size-edit',[
            'sizeEdit'=>$size,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size){
        $size->size_name=$request->size_name;
        $size->save();
        return redirect()->route('size.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size){
        $size->delete();
        return back();
    }

    //Size Status
    function sizeStatus($id){
        $size = Size::findOrFail($id);
        if ($size->status==1) {
            $size->status=2;
            $size->save();
        }
        else{
            $size->status=1;
            $size->save();
        }
        return back();
    }

    // Size Restore
    function sizeRestore($id){
        Size::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }
    //Size Permanent Delete
    function sizePerDelete($id){
        Size::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    } 
    
}
