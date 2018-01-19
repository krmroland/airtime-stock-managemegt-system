<?php

namespace App\Stock;


use App\Stock;

use App\Stock\Process;

Class Saver
{
	protected $process;

	protected $stock;

	/**
	 * creates an instance of the processor class
	 *
	 */
	public function __construct()
	{
		$this->process=app("stockProcess");

		$this->save();

	}
	

	public function save()
	{
		$stock=Stock::Create($this->process->stock());

		if ($this->process->isLoading($stock)) {
			$this->recordLoading($stock);
		}

		$this->stock=$stock;
	}

	protected function recordLoading($stock)
	{
		$stock->loaded()->create([
			"fielder_id"=>$this->process->fielder()->getKey()
			]);
	}

	public function stock()
	{
		return $this->stock;
	}
}