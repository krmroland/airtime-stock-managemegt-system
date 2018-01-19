<?php

namespace App;


use App\Summary\Stock;

use App\Summary\Payments;

Class Summary
{
	/**
	 * summaries me stock
	 *
	 * @return     App\Summary\Stock
	 */
	public static  function stock()
	{
		return new Stock();
	}
	/**
	 * summarize payments
	 *
	 * @return     App\Summary\Payments
	 */
	public static function payments()
	{
		return new Payments();
	}
	/**
	 * sumarize sales
	 */
	public function sales()
	{
		
	}
	
}