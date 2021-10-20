<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Billing;

class Country extends Model
{
    use HasFactory;

    function billing(){
        return $this->hasMany(Billing::class,'country_id');
    }
}
