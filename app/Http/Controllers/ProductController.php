<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductGallery;
use App\Models\Size;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Product.product-list',[
            'productCount'=>Product::count(),
            'products'=>Product::with(['category','subcategory','brand','productGallery','productAttribute.color','productAttribute.size'])->latest()->simplePaginate(),
        ]);
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
            'colors'=>Color::all(),
            'sizes'=>Size::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'product_title'=>['required','unique:products,product_title'],
            'category_id'=>['required'],
            'subcategory_id'=>['required'],
            'brand_id'=>['required'],
            'summary'=>['required'],
            'description'=>['required'],
            'price'=>['required'],
            'thumbnail'=>['required'],
            'image_name'=>['required'],           
        ],[
            'product_title.required'=>'Enter Title',
            'category_id.required'=>'Select Category',
            'subcategory_id.required'=>'Select Sub-Category',
            'brand_id.required'=>'Select Brand',
            'summary.required'=>'Enter Summary',
            'description.required'=>'Enter Description',
            'price.required'=>'Enter Minimum Price Price',
            'image_name.required'=>'Enter Image',            
            'thumbnail.required'=>'Enter Thumbnail',            
        ]);
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
            $thumbnail=$request->file('thumbnail');
            $product = Product::findOrFail($product->id);
            $file_name = $product->id.'_'.$product->product_title.'.'.$thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->save(public_path('product/thumbnail/'.$file_name));
            $product->thumbnail=$file_name;
            $product->save();
        }
        // Product Gallery Insert
        if ($request->hasFile('image_name')) {
            $gallaries=$request->file('image_name');
            foreach ($gallaries as $key => $gallery) {
               $fileNameGallery=$product->id.'-'.$product->product_title.Str::random('3').'.'.$gallery->getClientOriginalExtension();
               Image::make($gallery)->save(public_path('product/gallery/'.$fileNameGallery));
               $productGall = new ProductGallery;
               $productGall->product_id=$product->id;
               $productGall->image_name=$fileNameGallery;
               $productGall->save();              
            }
        }
        // Product Attribute Insert
        $colorIds = $request->color_id;
        foreach ($colorIds as $key => $colorId) {
            $prodiuctAttribute = new ProductAttribute;
            $prodiuctAttribute->product_id=$product->id;
            $prodiuctAttribute->color_id=$colorId;
            $prodiuctAttribute->size_id=$request->size_id[$key];
            $prodiuctAttribute->product_price=$request->product_price[$key];
            $prodiuctAttribute->quantity=$request->quantity[$key];
            $prodiuctAttribute->save();
        }
        $notication=array(
            'message'=>'Product Added Successfully',
            'alert-type'=>'success',
        );
        return back()->with($notication);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product){
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product){
        $subcategory = SubCategory::where('category_id',$product->category_id)->get();
        return view('Backend.Product.product-edit',[
            'categories'=>Category::all(),
            'brands'=>Brand::all(),
            'colors'=>Color::all(),
            'sizes'=>Size::all(),
            'productEdit'=>$product,
            'subcategories'=>$subcategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product){
        $request->validate([
            'product_title'=>['required'],
            'category_id'=>['required'],
            'subcategory_id'=>['required'],
            'brand_id'=>['required'],
            'summary'=>['required'],
            'description'=>['required'],
            'price'=>['required'],
        ],[
            'product_title.required'=>'Enter Title',
            'category_id.required'=>'Select Category',
            'subcategory_id.required'=>'Select Sub-Category',
            'brand_id.required'=>'Select Brand',
            'summary.required'=>'Enter Summary',
            'description.required'=>'Enter Description',
            'price.required'=>'Enter Minimum Price Price',
        ]);
        $product->product_title=$request->product_title;
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->brand_id=$request->brand_id;
        $product->summary=$request->summary;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->save();
        // thumbnail Update
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $file_name=$product->id.'_'.$product->product_title.'.'.$thumbnail->getClientOriginalExtension();
            $oldPath=public_path('product/thumbnail/'.$product->thumbnail);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            Image::make($thumbnail)->save('product/thumbnail/'.$file_name);
            $product->thumbnail=$file_name;
            $product->save();
        }
        // Product Gallery Update
        if ($request->hasFile('image_name')) {
            $ProductGallery = $request->file('image_name');
            foreach ($ProductGallery as $key => $galleries) {
                $pGallery = ProductGallery::findOrFail($request->pgallery[$key]);
                $file_name=$pGallery->product_id.'-'.$request->product_title.Str::random(3).'.'.$galleries->getClientOriginalExtension();
                $oldPath=public_path('product/gallery/'.$pGallery->image_name);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
                Image::make($galleries)->save(public_path('product/gallery/'.$file_name));
                $pGallery->product_id=$pGallery->product_id;
                $pGallery->image_name=$file_name;
                $pGallery->save();
            }
        }

        $quantities = $request->quantity;
        foreach ($quantities as $key => $quantity) {
            $attributeUpdate = ProductAttribute::findOrFail($request->attribute_id[$key]);
            $attributeUpdate->product_id=$attributeUpdate->product_id;
            $attributeUpdate->color_id=$request->color_id[$key];
            $attributeUpdate->size_id=$request->size_id[$key];
            $attributeUpdate->product_price=$request->product_price[$key];
            $attributeUpdate->quantity=$quantity;
            $attributeUpdate->save();            
        }

        $notication=array(
            'message'=>'Product Update Successfully',
            'alert-type'=>'success',
        );

        return back()->with($notication);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product){
        $product->delete();
        ProductGallery::where('product_id',$product->id)->delete();
        ProductAttribute::where('product_id',$product->id)->delete();

        $notication=array(
            'message'=>'Product Moved To Trash',
            'alert-type'=>'warning',
        );

        return back()->with($notication);
    }

    // Product Trash

    function productTrash(){
        return view('Backend.Product.product-trash',[
            'trashes'=>Product::onlyTrashed()->simplePaginate(),
            'trasheCount'=>Product::onlyTrashed()->count(),
        ]);
    }

    // Product Restore

    function productRestore($id){
        Product::onlyTrashed()->findOrFail($id)->restore();
        ProductGallery::onlyTrashed()->where('product_id',$id)->restore();
        ProductAttribute::onlyTrashed()->where('product_id',$id)->restore();
           $notication=array(
               'message'=>'Product Restore Successfully',
               'alert-type'=>'success',
           );
           return back()->with($notication);
    }
    // Product Permanent Delete

    function productPerDelete($id){
        Product::onlyTrashed()->findOrFail($id)->forceDelete();
        ProductAttribute::onlyTrashed()->where('product_id',$id)->forceDelete();
        ProductGallery::onlyTrashed()->where('product_id',$id)->forceDelete();
          $notication=array(
            'message'=>'Product Deleted Permanently',
            'alert-type'=>'error',
          );
          return back()->with($notication);        
    }



    function getSubCategory($cat_id){
        $subCategory = subCategory::where('category_id',$cat_id)->get();
        return response()->json($subCategory);
    }





















}
