<?php

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

function cart(){
    $oldCookieId=Cookie::get('cookie_id');
    return Cart::with('product')->where('cookie_id',$oldCookieId)->get();
}
function cartCount(){
    return Cart::count();
}

function wishlist(){
    return Wishlist::with('product')->where('user_id',Auth::id())->get();
}

function wishCount(){
    return Wishlist::where('user_id',Auth::id())->count();
}

?>