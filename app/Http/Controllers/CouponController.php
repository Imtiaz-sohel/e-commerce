<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('Backend.Coupon.coupon',[
            'coupons'=>Coupon::latest()->simplePaginate(),
            'couponCount'=>Coupon::count(),
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
            'coupon_name'=>['required'],
            'code'=>['required','unique:coupons,code'],
            'discount_type'=>['required'],
            'discount_amount'=>['required'],
            'starting_date'=>['required'],
            'ending_date'=>['required'],
            'min_order'=>['required'],
        ],[
            'coupon_name.required'=>'Enter Coupon Name',
            'code.required'=>'Enter Coupon Code',
            'code.unique'=>'Coupon Code Exists',
            'discount_type.required'=>'Enter Discount Type',
            'discount_amount.required'=>'Enter Discount Amount',
            'starting_date.required'=>'Enter Coupon Start Date',
            'ending_date.required'=>'Enter Coupon End Date',
            'min_order.required'=>'Enter Minimum Amount',            
        ]);
        $coupon = new Coupon;
        $coupon->coupon_name=$request->coupon_name;
        $coupon->code=$request->code;
        $coupon->discount_type=$request->discount_type;
        $coupon->discount_amount=$request->discount_amount;
        $coupon->starting_date=$request->starting_date;
        $coupon->ending_date=$request->ending_date;
        $coupon->min_order=$request->min_order;
        $coupon->save();
        $notification=array(
            'message'=>'Coupon Added Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon){
        return view('Backend.Coupon.coupon-edit',[
            'couponEdit'=>$coupon,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon){
        $request->validate([
            'coupon_name'=>['required'],
            'code'=>['required'],
            'discount_type'=>['required'],
            'discount_amount'=>['required'],
            'starting_date'=>['required'],
            'ending_date'=>['required'],
            'min_order'=>['required'],
        ],[
            'coupon_name.required'=>'Enter Coupon Name',
            'code.required'=>'Enter Coupon Code',
            'discount_type.required'=>'Enter Discount Type',
            'discount_amount.required'=>'Enter Discount Amount',
            'starting_date.required'=>'Enter Coupon Start Date',
            'ending_date.required'=>'Enter Coupon End Date',
            'min_order.required'=>'Enter Minimum Amount',            
        ]);
        $coupon->coupon_name=$request->coupon_name;
        $coupon->code=$request->code;
        $coupon->discount_type=$request->discount_type;
        $coupon->discount_amount=$request->discount_amount;
        $coupon->starting_date=$request->starting_date;
        $coupon->ending_date=$request->ending_date;
        $coupon->min_order=$request->min_order;
        $coupon->save();
        $notification=array(
            'message'=>'Coupon Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon){
        $coupon->delete();
        return back();
    }

    function couponStatus($id){
        $coupon = Coupon::findOrFail($id);
        if ($coupon->status==1) {
            $coupon->status=2;
            $coupon->save();
        }
        else{
            $coupon->status=1;
            $coupon->save();
        }
        return back();
    }

}
