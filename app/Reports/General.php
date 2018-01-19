<?php

namespace App\Reports;

Class General implements \JsonSerializable
{
	public function stock()
	{
		return new DailyStockProcessor();
	}

	public function payments()
	{
		return 
	}


}