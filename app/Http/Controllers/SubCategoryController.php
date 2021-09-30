<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Subcategory.sub-category',[
            'categories'=>Category::all(),
            'subCategories'=>subCategory::with(['category'])->latest()->simplePaginate(3,['*'],'subCat'),
            'subCategoryCount'=>subCategory::count(),
            'subCategoryTrashes'=>subCategory::with(['category'])->onlyTrashed()->simplePaginate(2,['*'],'subTrash'),
            'subCategoryTrashesCount'=>subCategory::with(['category'])->onlyTrashed()->count(),
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
            'category_id'=>['required'],
            'subcategory_name'=>['required','unique:sub_categories,subcategory_name']
        ],[
            'category_id.required'=>'Please Select Category',
            'subcategory_name.required'=>'Enter Sub-Category Name',
            'subcategory_name.unique'=>'Sub-Category Already Exists',
        ]);
        $subCategory = new subCategory;
        $subCategory->category_id=$request->category_id;
        $subCategory->subcategory_name=$request->subcategory_name;
        $subCategory->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(subCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(subCategory $subCategory){
        return view('Backend.Subcategory.sub-category-edit',[
            'subcategoryEdit' => $subCategory,
            'categories'=>Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subCategory $subCategory){
        $subCategory->category_id=$request->category_id;
        $subCategory->subcategory_name=$request->subcategory_name;
        $subCategory->save();
        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(subCategory $subCategory){
        $subCategory->delete();
        return back();
    }

    // Subcategory Status Update
    function subcategoryStatus($id){
        $subCategory = subCategory::findOrfail($id);
        if ($subCategory->status==1) {
            $subCategory->status=2;
            $subCategory->save();
        }
        else{
            $subCategory->status=1;
            $subCategory->save();
        }
        return back();
    }
    //SubCategory Restore
    function subCategoryRestore($id){
       subCategory::onlyTrashed()->findOrFail($id)->restore();
       return back();
    }
    //SubCategory Permanent Delete
    function subCategoryPerDelete($id){
        subCategory::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }  
}
