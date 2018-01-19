<?php

namespace App;

Class DenominationQuantity implements \JsonSerializable
{

	public $quantity;

	public $weight;

	public $percentage;

	public function __construct($quantity,$weight,$percentage)
	{
		$this->quantity = $quantity;

		$this->weight = $weight;

		$this->percentage = $percentage;
	}

	public function net()
	{
		return $this->gross()*(1-$this->percentage/100);
	}
	
	public function gross()
	{
		return $this->weight*$this->quantity;
	}

	public function pieces()
	{
		return $this->quantity;
	}
	
	public function jsonSerialize()
	{
		return[
		"pieces"=>(int)$this->quantity,
		"gross"=>$this->gross(),
		"net"=>$this->net(),
		];
	}
	/**
	 * magically transalate properties to methods on this class
	 *
	 * @param      string  $property  The property
	 *
	 * @return     mixed  
	 */
	public function __get($property)
	{

		return $this->{$property}();
	}

	/**
	 * Returns a string representation of the object.
	 *
	 * @return     string  
	 */
	public function __toString()
	{
		return nf($this->quantity);
	}

}