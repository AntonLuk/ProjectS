<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeedsController extends Controller
{
    public function show(){
        return view('leeds.new');
    }
}
