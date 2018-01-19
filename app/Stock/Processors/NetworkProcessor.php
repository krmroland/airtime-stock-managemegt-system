<?php

namespace App\Stock\Processors;

use App\Stock\Process;

use Illuminate\Support\Facades\DB;

class NetworkProcessor
{		
	/**
	 * @var App\Stock\Processor
	 */
	protected $processor;


    /**
     * craete a new instance of the processor
     */
    public function __construct()
    {

    	$this->process = app("stockProcess");
    }
    /**
     * save the networks
     *
     * @return     Illuminate\Support\Collection
     */
    public function process($stock)
    {

    	DB::table("networks")->insert($this->prepare($stock));

        $stock->load("networks");

    }
    /**
     * preapere the denominations
     *
     * @return     array
     */
    public function prepare($stock)
    {
        foreach ($this->process->quantities() as $network=>$denominations) {


          $stock_id=$stock->stock_id;

          $net=$this->process->netTotal($network);

          $loading=$this->process->loading($network);

          $gross=$this->process->grossTotal($network);

          $name=$network;

          $networks[]=compact("name", "loading", "stock_id","net","gross");


        }


    	return $networks;
    }
}
