<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;

class BillController extends Controller{
    function allBill(){
        return view('Backend.Bill.all-bill',[
            'billings'=>Billing::with(['country','state','city'])->latest()->simplePaginate(),
            'billingCount'=>Billing::count(),
        ]);
    }

    function orderByBill($billing_id){
        return view('Backend.Bill.order-by-bill',[
            'orders'=>Order::with(['product','color','size','billing'])->where('billing_id',$billing_id)->get(), 
        ]);
    }

    function shipping($billing_id){
        return view('Backend.Bill.order-shipping',[
            'shipping'=>Shipping::where('billing_id',$billing_id)->first(),
        ]);
    }
}



