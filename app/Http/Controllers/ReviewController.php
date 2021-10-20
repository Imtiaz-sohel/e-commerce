<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller{
    function ReviewPost(Request $request){
        $request->validate([
            'message'=>['required'],
            'ratting'=>['required'],
        ],[
            'message.required'=>'Please Enter Your Review',
            'ratting.required'=>'Please Give Ratting',
        ]);
        $review = new Review;
        $review->user_id=Auth::id();
        $review->product_id=$request->product_id;
        $review->name=$request->name;
        $review->email=$request->email;
        $review->message=$request->message;
        $review->ratting=$request->ratting;        
        $review->save();
        $notification=array(
            'message'=>'Review Added Sucessfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }
}
