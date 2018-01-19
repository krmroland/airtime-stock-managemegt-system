<?php

namespace App\Reports;

Class Daily implements \JsonSerializable
{
	/**
	 * the date 
	 */
	protected $date;

	/**
	 * creates an instance of the daily report class
	 *
	 * @param      string  $date   The date
	 */
	public function __construct($date=null)
	{
		$this->date=new DateProcessor($date);
	}


	public function stock()
	{
		return (new Stock($this->date))->data();
	}


	public function jsonSerialize()
	{
		return [
			"stock"=>$this->stock(),
		];
	}
}