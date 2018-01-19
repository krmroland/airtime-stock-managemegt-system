<?php

namespace App\Reports;

use App\Denomination;

use App\Reports\StockCompiler;

use Illuminate\Support\Facades\DB;

class Stock extends Report 
{
    protected $data;

    /**
     * compiles the stock related data
     *
     * @return     Collection
     */
    public function data()
    {
    	if (!isset($this->data)) {
    		$this->setData();
    	}
    	
    	return $this->data->data();
    }

    /**
     * the name of the base table
     *
     * @return     string
     */
    public function table()
    {
        return "stocks";
    }
 

    /**
     * Sets the data.
     *
     * @return    self
     */
    public function setData()
    {
    	$data=$this
    		->baseQuery()
    		->leftJoin("networks","stocks.stock_id","networks.stock_id")
    		->leftJoin("denominations","networks.network_id","denominations.network_id")
    		->get();
            
    	$this->data= new StockCompiler($data);

    	return $this;
    }

  
}
