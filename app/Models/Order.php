<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Billing;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

class Order extends Model
{
    use HasFactory;

    function billing(){
        return $this->belongsTo(Billing::class,'billing_id');
    }
    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    function color(){
        return $this->belongsTo(Color::class,'color_id');
    }
    function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
