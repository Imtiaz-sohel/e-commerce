<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\FeaturedProduct;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function frontPage(){
        return view('Frontend.index',[
            'products'=>Product::latest()->get(),
            'fProducts'=>FeaturedProduct::latest()->get(),
            'testimonials'=>Testimonial::latest()->get(),
        ]);
    }

    function singleProduct($slug){
        $sProduct=Product::where('slug',$slug)->first();
        $rProducts=Product::where('category_id',$sProduct->category_id)->where('slug','!=',$sProduct->slug)->get();
        return view('Frontend.single-product',[
            'sProduct'=>$sProduct,
            'rProducts'=>$rProducts,
            'pGalleries'=>ProductGallery::where('product_id',$sProduct->id)->get(),
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



































}
