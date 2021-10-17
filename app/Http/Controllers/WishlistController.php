<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller{
    function __construct(){
        return $this->middleware('auth');
    }
    
    function wishlist(){
        return view('Frontend.wishlist',[
            'wishlists'=>Wishlist::with('product')->where('user_id',Auth::id())->get(),
        ]);
    }

    function addTowishlist($product_id){
        $userId=Auth::id();
        $wishList=Wishlist::where('product_id',$product_id)->where('user_id',$userId);
        if ($wishList->exists()) {
            $notification=array(
                'message'=>'Product Already in Wishlist',
                'alert-type'=>'info',
            );
            return back()->with($notification);
        }
        else{
           $wishlist=new Wishlist;
           $wishlist->user_id=$userId;
           $wishlist->product_id=$product_id;
           $wishlist->save();
           $notification=array(
            'message'=>'Product Added To Wishlist',
            'alert-type'=>'success',
          );
           return back()->with($notification);          
        }
    }

    function wishlistDelete($id){
        Wishlist::findOrFail($id)->delete();
        return back();
    }

}
