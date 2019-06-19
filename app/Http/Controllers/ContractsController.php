<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use Illuminate\Support\Facades\Auth;
class ContractsController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('administrator')){
            $contracts=Contract::paginate(10);
        }else{
          //  $contracts=Contract::where()
        }
        return view('contracts.index',compact('contracts'));
    }
}
