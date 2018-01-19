<?php

namespace App\Http\Controllers;


use App\Reports\Daily;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * show a list of a ll reports
     *
     * @return     Illuminate\Contracts\View\View
     */
    public function index()
    {
    	return view("reports.index");
    }
   

    public function data(Request $request, Stock $report)
    {

        return response()->json($report);
    }

    public function daily(Daily $daily)
    {

        return response()->json($daily);
    }




}
