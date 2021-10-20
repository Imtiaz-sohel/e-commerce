<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Billing;

class City extends Model
{
    use HasFactory;

    function billing(){
        return $this->hasMany(Billing::class,'city_id');
    }
}
