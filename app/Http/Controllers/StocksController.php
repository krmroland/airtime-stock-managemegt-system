<?php

namespace App\Http\Controllers;

use App\Store;
use App\Stock\Processor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;



class StocksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $store=Store::open();

     if (empty($store)) {
           Artisan::call("db:seed",['--force' => true,]);
           $store=Store::open();
     }
     return view("stock.index",compact("store"));



 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("stock.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->dispatch(app(Processor::class));


        flash("Stock was loaded successfully");
        
        return redirect()->route("home");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $load)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function edit(Load $load)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Load $load)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function destroy(Load $load)
    {
        //
    }
}
