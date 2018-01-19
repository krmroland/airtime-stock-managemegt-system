<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Payment;
use App\Summary;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $stock=Stock::today();

        // $payments=Payment::today();

        return view('home');
    }
}
