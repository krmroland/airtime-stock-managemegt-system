<?php

namespace App\Stock;

use App\Store;

use App\Fielder;

use Illuminate\Http\Request;

Class Process
{
	/**
	 * the date  when the transaction was made
	 * 
	 * @var String
	 */
	protected $date;

	/**
	 * the form data
	 * @var array
	 */
	protected $data;

	/**
	 * the fielder related to the stock
	 * 
	 * @var App\Fielder|null
	 */
	protected $fielder;

	/**
	 * create and instance of the data class
	 *
	 * @param      \Illuminate\Http\Request  $request  
	 */
	public function __construct(Request $request)
	{
		$this->date= $request->date;

		$this->data=json_decode($request->data,true);

		if ($request->has("fielder_id")) {
			$this->fielder=Fielder::findOrFail($request->fielder_id);
		}

	}

	/**
	 * get the date
	 *
	 * @return     string  
	 */
	public function date()
	{
		return $this->date;
	}

	/**
	 * the stock related data for the Stock model
	 * 
	 * @see App\Stock
	 * 
	 * @return     array  
	 */
	public function stock()
	{

		return [
		"net"=>$this->netTotal(),
		"description"=>$this->description(),
		"date"=>$this->date()
		];
	}

	/**
	 * Determines if loading.
	 *
	 * @return     boolean  True if loading, False otherwise.
	 */
	public function isLoading()
	{
		return isset($this->fielder);
	}
	/**
	 * Determines if purchasing.
	 *
	 * @return     boolean  True if purchasing, False otherwise.
	 */
	public function isPurchasing()
	{
		return !$this->isLoading();
	}
	/**
	 * computes the stock nettoal
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function netTotal($network=null)
	{
		if(!$network){
			return $this->data["stockValue"];
		}

		return $this->data["netTotal"][$network];
		
	}

	public function grossTotal($network)
	{
		return $this->data["grossTotal"][$network];
	}

	public function quantities()
	{
		return $this->data["quantities"];
	}

	public function hasSerials()
	{
		return  !empty(array_wrap($this->data["serials"]));
	}
	public function fielder()
	{
		return $this->fielder;
	}

	public function serials()
	{
		return $this->data["serials"];
	}

	public function networks()
	{
		
	}


	public function description()
	{
		if ($this->isLoading()) {


			return "issued_stock";
		}
		if ($this->isPurchasing()) {
			return "purchased_stock";
		}
	}

	public function loading($network)
	{

		if ($this->isLoading()) {
			return $this->fielder->loading[$network];
		}
		if ($this->isPurchasing()) {
			return Store::loading()[$network];
		}


	}



	
}