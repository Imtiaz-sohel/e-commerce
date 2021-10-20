<?php

namespace App\Http\Controllers;

use App\Exports\BillingsExport;
use App\Models\Billing;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Excel;
use PDF;

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

    function billSearch(Request $request){
        $start = $request->start;
        $end = $request->end;
        $orderSearch = Billing::whereBetween('created_at', [$start, $end])->get();
        $orderSearchCount = Billing::whereBetween('created_at', [$start, $end])->count();
        return view('Backend.Bill.all-bill',[
            'orderSearch'=>$orderSearch,
            'orderSearchCount'=>$orderSearchCount,
            'start'=>$start,
            'end'=>$end,
        ]);
    }

    function billDownload(Request $request){
        $start = $request->start;
        $end = $request->end;
        if ($request->execl) {
            return Excel::download(new BillingsExport($start,$end), 'invoices.xlsx');
        }
        else{
            $orderSearch = Billing::whereBetween('created_at', [$start, $end])->get();
            $pdf = PDF::loadView('exports.billing',compact('orderSearch'));
            return $pdf->download('invoice.pdf');  
        }
    }





















}



