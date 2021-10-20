<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Billing;

class State extends Model
{
    use HasFactory;

    function billing(){
        return $this->hasMany(Billing::class,'state_id');
    }
}
