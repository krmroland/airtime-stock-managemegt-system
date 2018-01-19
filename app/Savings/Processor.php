<?php

namespace App\Savings;

Class Processor
{
	/**
	 * a collection of fielders
	 * @var Illuminate\Database\Eloquent\Collection
	 */
	protected $fielders;

	/**
	 * creates an instance of the processor class
	 *
	 * @param      Illuminate\Support\Collection  $fielders 
	 */
	public function __construct($fielders)
	{
		$this->fielders = $fielders;
		
	}
	
}