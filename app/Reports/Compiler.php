<?php

namespace App\Reports;

use App\Reports\Report;

Class Compiler
{
	
	protected $report;


	public function __construct(Report $report)
	{
		$this->report=$report;
	}


	public function compile()
	{
		return $this->report->compile();
	}


}