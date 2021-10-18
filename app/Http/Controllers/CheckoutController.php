<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\ProductAttribute;
use App\Models\Shipping;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Stripe;

class CheckoutController extends Controller{
    function __construct(){
        return $this->middleware('auth');
    }
    function checkoutPage(){
        $oldCookieId=Cookie::get('cookie_id');
        $carts=Cart::where('cookie_id',$oldCookieId)->get();
        $slug = session('coupon');
        $coupon = Coupon::where('code',$slug)->first();
        $countries=Country::latest()->get();
        return view('Frontend.checkout',[
            'carts'=>$carts,
            'coupon'=>$coupon,
            'countries'=>$countries,
        ]);
    }


    function getStateList($country_id){
        $states = State::where('country_id',$country_id)->get();
        return response()->json($states);
    }

    function getCityList($state_id){
        $cities = City::where('state_id',$state_id)->get();
        return response()->json($cities);
    }

    function checkoutPost(Request $request){
       $userId = Auth::id();
       $differentShipping = $request->different_shipping ?? 1;
       if ($request->pay_type=="bank") {
           $request->validate([
            'full_name'=>['required'],
            'country_id'=>['required'],
            'state_id'=>['required'],
            'city_id'=>['required'],
            'address'=>['required'],
            'zip_code'=>['required'],
            'phone'=>['required'], 
           ],[
            'full_name.required'=>'Enter Full Name',
            'country_id.required'=>'Selct Country',
            'state_id.required'=>'Enter State',
            'city_id.required'=>'Enter City',
            'address.required'=>'Enter Address',
            'zip_code.required'=>'Enter Zip Code',
            'phone.required'=>'Enter Phone Number',
           ]);
           $billing = new Billing;
           $billing->user_id=$userId;
           $billing->full_name=$request->full_name;
           $billing->company_name=$request->company_name;
           $billing->email=$request->email;
           $billing->country_id=$request->country_id;
           $billing->state_id=$request->state_id;
           $billing->city_id=$request->city_id;
           $billing->address=$request->address;
           $billing->zip_code=$request->zip_code;
           $billing->phone=$request->phone;
           $billing->pay_type='bank';
           $billing->notes=$request->notes;
           $billing->save();
           if ($differentShipping==2) {
               $request->validate([
                's_country_id'=>['required'],
                's_state_id'=>['required'],
                's_city_id'=>['required'],
                's_full_name'=>['required'],
                's_phone'=>['required'],
                's_address'=>['required'],
                's_zip_code'=>['required'],
              ],[
                's_country_id.required'=>'Selct Country',
                's_state_id.required'=>'Selct State',
                's_city_id.required'=>'Selct City',
                's_full_name.required'=>'Enter Full Name',
                's_phone.required'=>'Enter Phone Number',
                's_address.required'=>'Enter Address',
                's_zip_code.required'=>'Enter Zip Code',
              ]);
              $shipping = new Shipping;
              $shipping->user_id=$userId;
              $shipping->billing_id=$billing->id;
              $shipping->s_country_id=$request->s_country_id;
              $shipping->s_state_id=$request->s_state_id;
              $shipping->s_city_id=$request->s_city_id;
              $shipping->s_full_name=$request->s_full_name;
              $shipping->s_company_name=$request->s_company_name;
              $shipping->s_email=$request->s_email;
              $shipping->s_phone=$request->s_phone;
              $shipping->s_address=$request->s_address;
              $shipping->s_zip_code=$request->s_zip_code;
              $shipping->save();              
           }
        //   Store data in order table from cart table
          $oldCookieId = Cookie::get('cookie_id');
          $carts=Cart::where('cookie_id',$oldCookieId)->get();
          $subtotal=0;
          foreach ($carts as $key => $cart) {
              $unitPrice=ProductAttribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->product_price; 
              $order = new Order;
              $order->billing_id=$billing->id;
              $order->product_id=$cart->product_id;
              $order->color_id=$cart->color_id;
              $order->size_id=$cart->size_id;
              $order->product_price=$unitPrice;
              $order->quantity=$cart->quantity;
              $order->save();
              $subtotal+=$unitPrice*$cart->quantity;            
          }
        // total_amount & discount Calculation
        $slug = session('coupon');
        $coupon = Coupon::where('code',$slug)->first();
        if ($coupon=="") {
            $discount="N/A";
        }
        elseif($coupon->discount_type==1){
            $discount=$coupon->discount_amount.'%';
        }
        elseif($coupon->discount_type==2){
            $discount='$'.$coupon->discount_amount;
        }

        if ($coupon=="") {
          $payAmount=$subtotal; 
        }
        elseif($coupon->discount_type==1){
            $payAmount=$subtotal-($coupon->discount_amount/100*$subtotal);
        }
        elseif($coupon->discount_type==2){
            $payAmount=$subtotal-$coupon->discount_amount;
        }

        // Decrement product Quantity after order
        $orders = Order::where('billing_id',$billing->id)->get();
        foreach ($orders as $key => $order) {
            $attributeQuantity=ProductAttribute::where('product_id',$order->product_id)->where('color_id',$order->color_id)->where('size_id',$order->size_id)->first();
            $attributeQuantity->decrement('quantity',$order->quantity);
            $attributeQuantity->save();
        }
            $afterPay = Billing::findOrFail($billing->id);
            $afterPay->payment_status=2;
            $afterPay->total_amount=$payAmount;
            $afterPay->discount=$discount;
            $afterPay->save();
            return redirect()->route('orderConfirmed',$billing->id);
       }
       elseif($request->pay_type=="card"){
        $request->validate([
            'full_name'=>['required'],
            'country_id'=>['required'],
            'state_id'=>['required'],
            'city_id'=>['required'],
            'address'=>['required'],
            'zip_code'=>['required'],
            'phone'=>['required'], 
           ],[
            'full_name.required'=>'Enter Full Name',
            'country_id.required'=>'Selct Country',
            'state_id.required'=>'Enter State',
            'city_id.required'=>'Enter City',
            'address.required'=>'Enter Address',
            'zip_code.required'=>'Enter Zip Code',
            'phone.required'=>'Enter Phone Number',
           ]);
           $billing=new Billing;
           $billing->user_id=Auth::id();
           $billing->full_name=$request->full_name;
           $billing->company_name=$request->company_name;
           $billing->email=$request->email;
           $billing->country_id=$request->country_id;
           $billing->state_id=$request->state_id;
           $billing->city_id=$request->city_id;
           $billing->address=$request->address;
           $billing->zip_code=$request->zip_code;
           $billing->phone=$request->phone;
           $billing->pay_type="card";
           $billing->notes=$request->notes;
           $billing->save();
           if ($differentShipping==2) {
            $request->validate([
                's_country_id'=>['required'],
                's_state_id'=>['required'],
                's_city_id'=>['required'],
                's_full_name'=>['required'],
                's_phone'=>['required'],
                's_address'=>['required'],
                's_zip_code'=>['required'],
              ],[
                's_country_id.required'=>'Selct Country',
                's_state_id.required'=>'Selct State',
                's_city_id.required'=>'Selct City',
                's_full_name.required'=>'Enter Full Name',
                's_phone.required'=>'Enter Phone Number',
                's_address.required'=>'Enter Address',
                's_zip_code.required'=>'Enter Zip Code',
              ]);
                $shipping = new Shipping;
                $shipping->user_id=Auth::id();
                $shipping->billing_id=$billing->id;
                $shipping->s_country_id=$request->s_country_id;
                $shipping->s_state_id=$request->s_state_id;
                $shipping->s_city_id=$request->s_city_id;
                $shipping->s_full_name=$request->s_full_name;
                $shipping->s_company_name=$request->s_company_name;
                $shipping->s_email=$request->s_email;
                $shipping->s_phone=$request->s_phone;
                $shipping->s_address=$request->s_address;
                $shipping->s_zip_code=$request->s_zip_code;
                $shipping->save();
           }
           
    $oldCookieId=Cookie::get('cookie_id');
    $carts = Cart::where('cookie_id',$oldCookieId)->get();
    $subtotal=0;
    foreach ($carts as $key => $cart) {
        $unitPrice = ProductAttribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->product_price;
        $order = new Order;
        $order->billing_id=$billing->id;
        $order->product_id=$cart->product_id;
        $order->color_id=$cart->color_id;
        $order->size_id=$cart->size_id;
        $order->product_price=$unitPrice;
        $order->quantity=$cart->quantity;
        $order->save();
        $subtotal+=$unitPrice*$cart->quantity;               
    }

     $slug=session('coupon');
     $coupon=Coupon::where('code',$slug)->first();
     if ($coupon=="") {
         $discount="N/A";
     }
     elseif ($coupon->discount_type==1) {
        $discount=$coupon->discount_amount."%";
     }
     elseif ($coupon->discount_type==2) {
         $discount="$".$coupon->discount_amount;
     }
     if ($coupon=="") {
         $payAmount=$subtotal;
     }
     elseif ($coupon->discount_type==1) {
         $payAmount=$subtotal-($coupon->discount_amount/100*$subtotal);
     }
     elseif ($coupon->discount_type==2) {
         $payAmount=$subtotal-$coupon->discount_amount;
     }

     // Decrement product Quantity after order
     $orders=Order::where('billing_id',$billing->id)->get();
     foreach ($orders as $key => $order) {
         $productQuantity=ProductAttribute::where('product_id',$order->product_id)->where('color_id',$order->color_id)->where('size_id',$order->size_id)->first();
         $productQuantity->decrement('quantity',$order->quantity);
         $productQuantity->save();
     }

    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //Charge have all card related information
    Stripe\Charge::create([
        "amount" => $payAmount * 100,
        "currency" => "usd",
        // for test api source will be tok_visa otherwise stripeToken
        "source" => "tok_visa",
        "description" => "Test payment",
    ]);
    
    $afterPay=Billing::findOrFail($billing->id);
    $afterPay->payment_status='2';
    $afterPay->total_amount=$payAmount;
    $afterPay->discount=$discount;
    $afterPay->save();
    return redirect()->route('orderConfirmed',$billing->id);
}
       elseif($request->pay_type=="delivery"){
           return "Delivery";
       }
       else{
           return back()->with('error','Please Select A Payment Type');
       }
    }

    function orderConfimed($billing_id){
        return view('Frontend.order',[
            'orders'=>Order::with('billing')->where('billing_id',$billing_id)->get(),
        ]);
    }













































}
