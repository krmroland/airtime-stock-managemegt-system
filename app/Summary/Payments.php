<?php

namespace App\Summary;

use App\Payment;
use Illuminate\Support\Facades\DB;

Class Payments implements \JsonSerializable
{
	/**
	 * @var collection
	 */
	protected $payments;
	
	/**
	 * collect me the data for daily payments
	 *
	 * @param      string  $date   The date
	 *
	 * @return     self  
	 */
	public function daily($date=null)
	{
		$date=$date?:date("Y-m-d");

		$this->payments=Payment::whereDate("date",$date)
				->select(DB::raw("count(*) as count , sum(ammount) as total"))->first();

		return $this;
	}
	/**
	 * give me the total of all the payments that have been made
	 *
	 * @return     integer  
	 */
	public function total()
	{
		return $this->payments->total;
	}
	/**
	 * count me the number of payments madee
	 *
	 * @return     integer  
	 */
	public function count()
	{
		return $this->payments->count;
	}

	public function jsonSerialize()
	{
			return [
				"total_count"=>$this->count(), 
				"total_ammount"=>$this->total()
				];
	}
}