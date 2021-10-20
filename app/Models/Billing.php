<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order;
use App\Models\Country;
use App\Models\State;
use App\Models\Shipping;

class Billing extends Model
{
    use HasFactory,SoftDeletes;

    function order(){
        return $this->hasMany(Order::class,'billing_id');
    }
    function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    function city(){
        return $this->belongsTo(City::class,'city_id');
    }
    function shipping(){
        return $this->hasMany(Shipping::class,'billing_id');
    }
}
