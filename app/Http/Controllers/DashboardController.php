<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('owner'))
        {
            
            return view('owner.dashboard');
        }elseif(Auth::user()->hasRole('gudang'))
        {
            return view('gudang.dashboard');
        }else
        {
            return view('kasir.dashboard');
        }
    }
}
