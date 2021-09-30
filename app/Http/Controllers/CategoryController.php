<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Category.category-list',[
            'categories'=>Category::latest()->simplePaginate(3),
            'categoryCount'=>Category::count(),
            'categoryTrashes'=>Category::onlyTrashed()->simplePaginate(2),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('Backend.Category.category-list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
       $request->validate([
           'category_name'=>['required','unique:categories,category_name']
       ],[
           'category_name.required'=>'Enter Category',
           'category_name.unique'=>'Category Already Exists',
       ]); 
       $category = new Category;
       $category->category_name=$request->category_name;
       $category->save();
       return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category){
        return view('Backend.Category.category-edit',[
            'categoryEdit'=>$category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category){
        $category->category_name=$request->category_name;
        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category){
        $category->delete();
        return back();
    }

    function categoryRestore($id){
        Category::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }

    function categoryPerDelete($id){
        Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }

    // Category Status Update
    function categoryStatus($id){
         $catStatus = Category::findOrFail($id);
         if ($catStatus->status==1 ) {
            $catStatus->status=2;
            $catStatus->save();
         }
         else{
            $catStatus->status=1;
            $catStatus->save();
         }
         return back();
    }

}
