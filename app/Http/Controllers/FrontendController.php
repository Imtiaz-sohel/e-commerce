<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function frontPage(){
        return view('Frontend.index');
    }
}
