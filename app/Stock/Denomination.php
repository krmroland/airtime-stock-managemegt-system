<?php

namespace App\Stock;

Class Denomination
{
	/**
	 * the number of pieces of the denomination 
	 */
	protected $quantity;

	/**
	 * what the weight of the denomination is forexample 500 for half k
	 */
	protected $weight;
	/**
	 * the percentage Class
	 * @var App\Percentage
	 */
	protected $percentage;

	public $timestamps=false;
	/**
	 * insatiate this class
	 *
	 * @param      integer  $quantity  
	 * @param      integr  $weight    
	 */
	public function __construct($quantity, $weight,  $percentage)
	{
		$this->quantity = $quantity;

		$this->weight = $weight;
		
		$this->percentage = $percentage;
	}

	/**
	 * calculates the gross
	 *
	 * @return     integer  
	 */
	public function gross()
	{
		return $this->quantity*$this->weight;
	}
	/**
	 * calculates the net
	 * 
	 */
	public function net()
	{
		return $this->gross()*$this->percentage->discounted();
	}
	
}