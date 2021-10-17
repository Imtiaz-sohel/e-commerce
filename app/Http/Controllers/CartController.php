<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
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
    
    function cartPage($slug=""){
        if ($slug=="") {
            $minOrder=null;
            $discountType=null;
            $discountAmount=null;
            $oldCookie_id=Cookie::get('cookie_id');
            $carts=Cart::with(['product','color','size'])->where('cookie_id',$oldCookie_id)->get();
            return view('Frontend.cart',[
                'carts'=>$carts,
                'minOrder'=>$minOrder,
                'discountType'=>$discountType,
                'discountAmount'=>$discountAmount,
            ]);
        }
        else{
            $couponCheck = Coupon::where('code',$slug);
            if ($couponCheck->exists()) {
                if (Coupon::where('code',$slug)->first()->ending_date>=Carbon::now()) {
                    if (Coupon::where('code',$slug)->first()->status==1) {
                        $coupon = Coupon::where('code',$slug)->first();
                        $minOrder = $coupon->min_order;
                        $discountType = $coupon->discount_type;
                        $discountAmount = $coupon->discount_amount;
                        $oldCookie_id=Cookie::get('cookie_id');
                        $carts=Cart::with(['product','color','size'])->where('cookie_id',$oldCookie_id)->get();
                        session(['coupon'=>$slug]);
                        return view('Frontend.cart',[
                            'carts'=>$carts,
                            'minOrder'=>$minOrder,
                            'discountType'=>$discountType,
                            'discountAmount'=>$discountAmount,
                        ]);    
                    }
                    else{
                        return back()->with('invalidCoupon','These Coupon is Deactivated');
                    }
                }
                else{
                    return back()->with('invalidCoupon','Coupon Expired');
                }
            }
            else{
                return back()->with('invalidCoupon','Invalid Coupon');
            }
        }
    }

    function cartRemove($id){
        Cart::findOrFail($id)->delete();
        return back();
    }

    function CartUpdateAjax(Request $request){
        $cartUdate=Cart::findOrFail($request->id);
        $cartUdate->quantity=$request->qty;
        $cartUdate->save();
    }























}
