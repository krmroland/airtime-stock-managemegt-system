<?php

namespace App\Stock\Processors;

use Illuminate\Support\Facades\DB;


Class DenominationsProcessor
{
	protected $process;

	public function __construct(StoreProcessor $store)
	{

		$this->process = app("stockProcess");

        $this->store=$store;
	}
	/**
     * Saves denominations.
     *
     * @return     self
     */
    public function process($stock)
    {
        DB::table("denominations")->insert($this->prepare($stock));

        return $this;
    }
    /**
     * prepare denominations
     *
     * @return     array
     */
    public function prepare($stock)
    {
      

      foreach($this->process->quantities() as $network=>$denominations ){

        foreach ($denominations as $weight=>$quantity) {
           $prepared[]=$this
                        ->makeDenomination($stock,$network,$weight,$quantity);
        }

      }
      return $prepared;
      
    }

    protected function makeDenomination($stock,$network,$weight,$quantity)
    {
        $networks=$stock->networks->keyBy("name");

        return[
            "network_id"=>$networks[$network]->getKey(),
            "before_quantity"=>$this->store->before($network,$weight),
            "new_quantity"=>$quantity,
            "after_quantity"=>$this->store->after($network,$weight),
            "weight"=>$weight
        ];
    }
}