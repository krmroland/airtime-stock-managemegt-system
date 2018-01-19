<?php

namespace App\Reports;

use Illuminate\Http\Request;
use App\Reports\DateProcessor;
use Illuminate\Support\Facades\DB;


abstract Class Report
{
	abstract public function table();
	/**
	 * the date/ dates of the report
	 * 
	 * @var String
	 */
	protected $date;

	/**
	 * create an instance of the report class
	 *
	 * @param      \Illuminate\Http\Request  $request  
	 */
	public function __construct(DateProcessor $date)
	{
		$this->date=$date;
	}



	public function dates()
	{
		return $this->date;
	}

	public function queryDates()
	{
		return $this->date->dates();
	}



	public function formatedRange()
	{
		
	}


	public function baseQuery($dateColumn='date')
	{
		$dateColumn=$this->table().".$dateColumn";
		if ($this->date->isRange()) {
			return $this->model()
						->whereDate($dateColumn,">=",$this->date->from())
						->whereDate($dateColumn,"<=",$this->date->to());
		}

		return $this->model()->whereDate($dateColumn,(string)$this->date);
	}
	public function model()
	{
		return DB::table($this->table());
	}

}