<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order;

class Billing extends Model
{
    use HasFactory,SoftDeletes;

    function order(){
        return $this->hasMany(Order::class,'billing_id');
    }
}
