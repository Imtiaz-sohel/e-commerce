<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Category;
use App\Models\FeaturedProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductGallery;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    function frontPage(){
        $bestSellings = Order::with(['product'])->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total', 'DESC')->limit(4)->get();
        return view('Frontend.index',[
            'products'=>Product::latest()->get(),
            'fProducts'=>FeaturedProduct::latest()->get(),
            'testimonials'=>Testimonial::latest()->get(),
            'banners'=>Banner::latest()->get(),
            'bestSellings'=>$bestSellings,
        ]);
    }

    function singleProduct($slug){
        $sProduct=Product::where('slug',$slug)->first();
        $rProducts=Product::where('category_id',$sProduct->category_id)->where('slug','!=',$sProduct->slug)->get();
        $attribute = ProductAttribute::where('product_id',$sProduct->id)->get();
        $collect = collect($attribute);
        $groupByColors = $collect->groupBy('color_id');
        return view('Frontend.single-product',[
            'sProduct'=>$sProduct,
            'rProducts'=>$rProducts,
            'pGalleries'=>ProductGallery::where('product_id',$sProduct->id)->get(),
            'groupByColors'=>$groupByColors,
        ]);
    }

    function aboutUs(){
        return view('Frontend.about-us',[
            'aboutUs'=>About::latest()->first(),
        ]);
    }

    function shopPage(){
        return view('Frontend.shop',[
            'allproducts'=>Product::with(['category'])->latest()->get(),
            'categories'=>Category::with(['product'])->latest()->get(),
        ]);
    }


    function getProductSize($colorId,$productId){
        $attributes = ProductAttribute::where('color_id',$colorId)->where('product_id',$productId)->get();
        $output="";
        foreach ($attributes as $key => $attribute) {
            $output=$output.'<input data-price="'.$attribute->product_price.'" data-quantity="'.$attribute->quantity.'" class="size_check" type="radio" name="size_id" id="size_id'.$attribute->size_id.'" value="'.$attribute->size_id.'">&nbsp;<label for="size_id'.$attribute->size_id.'">'.$attribute->size->size_name.'</label>';
        }
        echo $output;
    }
}
