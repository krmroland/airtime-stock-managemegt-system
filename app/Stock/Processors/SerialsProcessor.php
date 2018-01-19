<?php

namespace App\Stock\Processors;



use Illuminate\Support\Facades\DB;

Class SerialsProcessor
{


	public function __construct()
	{
		$this->process=app("stockProcess");
	}
	/**
	 * Saves serial numbers.
	 *
	 * @return     self
	 */
	public function process($stock)
	{
		if ($this->process->hasSerials()) {
			DB::table("serials")->insert($this->prepare($stock));
		}
	   

	    return $this;
	}
	/**
	 * prepare serial numbers
	 *
	 * @return     array
	 */
	public function prepare($stock)
	{
	    foreach ($stock->networks->keyBy("name") as $name=>$network ) {
	        foreach ($network->denominations as $denomination) {
	           $serials[]=$this->make($name,$denomination) ;
	        }
	       
	    }
	   return array_filter($serials);
	}
	/**
	 * Makes a serial number.
	 *
	 * @param      App\Denomination  $denomination
	 *
	 * @return     array
	 */
	public function make($network,$denomination)
	{

	    $serials=$this->process->serials()[$network][$denomination->weight];

	    $from=intval($serials["from"]);

	    $to=intval($serials["to"]);

	    if( $to<$from){
	    	return [];
	    }


	    return[
	    "denomination_id"=>$denomination->id,
	    "from"=>$from,
	    "to"=>$to
	    ];
	}
	
}