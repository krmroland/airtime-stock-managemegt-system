<?php

namespace App;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;



Class Defaults
{
	/**
	 * denominations
	 *
	 * @return    Illuminate\Support\Collection
	 */
	public static function denominations()
	{
		return Cache::rememberForever("defaults.denominations",function(){
				return collect(Stock::DENOMINATIONS);
		});
			
	}
	/**
	 * default denominations
	 *
	 * @return     Illuminate\Support\Collection  
	 */
	public static function networks()
	{
		return Cache::rememberForever("defaults.networks",function (){
		    return collect(config("app.networks"));
		});
		
	}
	/**
	 * the loading details
	 *
	 * @return     Illuminate\Support\Collection
	 */
	public function loadingDetails()
	{
		return Cache::rememberForever("defaults.loadingDetails",function (){
		    return collect([
		    		"denominations"=>$this->denominations(),
		    		"networks"=>$this->networks(),
		    		"totals"=>$this->totalsStruture()
		    	]);
		});
	}
	/**
	 * stock totals network structure
	 *
	 * @return     Collection
	 */
	public function totalsStruture()
	{
		return collect(["gross","net"])->flip()->map(function ($index, $totalType){
		    return $this->networks()->flip()->map(function ($network){
		        return $this->denominations()->flip()->map(function ($value,$name){
		            return 0;
		        });
		    });
		});
	}

	public function availableStock()
	{
		return StockStore::all()->groupBy("network")->map(function ($network){
		    return $network->sortBy("weight")->pluck("quantity","weight");
		});
	}
}