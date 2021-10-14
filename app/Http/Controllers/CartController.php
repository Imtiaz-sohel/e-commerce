<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    function productCart(Request $request){
        $request->validate([
            'color_id'=>['required'],
            'size_id'=>['required'],
        ],[
            'color_id.required'=>'Please Select Color',
            'size_id.required'=>'Please Select Size',            
        ]);
        $oldCookie_id=Cookie::get('cookie_id');
        if ($oldCookie_id) {
            $cookie_id=$oldCookie_id;
        }
        else {
            $minute='43200';
            $cookie_id=Str::random('10');
            Cookie::queue('cookie_id',$cookie_id,$minute);
        }

        $product_id=Product::findOrFail($request->product_id)->id;
        $cartIncrement=Cart::where('cookie_id',$oldCookie_id)->where('product_id',$product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id);
        if ($cartIncrement->exists()) {
            $cartIncrement->increment('quantity',$request->quantity);
            $message=array(
                'message'=>'Product Add To Cart',
                'alert-type'=>'success',
            );
            return back()->with($message);   
        }
        else{
            $carts = new Cart;
            $carts->cookie_id=$cookie_id;
            $carts->product_id=$product_id;
            $carts->color_id=$request->color_id;
            $carts->size_id=$request->size_id;
            $carts->quantity=$request->quantity;
            $carts->save();
            $message=array(
                'message'=>'Product Add To Cart',
                'alert-type'=>'success',
            );
            return back()->with($message);           
        }
    }
    
    function cartPage(){
        return view('Frontend.cart',[
            'carts'=>Cart::with(['product','color','size'])->get(),
        ]);
    }

    function cartRemove($id){
        Cart::findOrFail($id)->delete();
        return back();
    }
























}
