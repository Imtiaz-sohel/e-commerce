<?php

namespace App\Exports;

use App\Models\Billing;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BillingsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $start;
    protected $end;
    function __construct($start,$end){
        $this->start=$start;
        $this->end=$end;
    }

    public function view(): View{
        $orderSearch = Billing::whereBetween('created_at', [$this->start, $this->end])->get();
        return view('exports.billing', [
            'orderSearch'=>$orderSearch,
        ]);
    }
}

