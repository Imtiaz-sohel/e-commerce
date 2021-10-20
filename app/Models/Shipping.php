<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Billing;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class Shipping extends Model
{
    use HasFactory;

    function billing(){
        return $this->belongsTo(Billing::class,'billing_id');
    }
    function country(){
        return $this->belongsTo(Country::class,'s_country_id');
    }
    function state(){
        return $this->belongsTo(State::class,'s_state_id');
    }
    function city(){
        return $this->belongsTo(City::class,'s_city_id');
    }
}
