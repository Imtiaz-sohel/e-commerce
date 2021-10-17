<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller{
    function __construct(){
        return $this->middleware('auth');
    }
    function checkoutPage(){
        return view('Frontend.checkout');
    }
}
