<?php

namespace App\Summary;

use App\Denomination;
use App\Stock as BaseStock;
use Illuminate\Support\Facades\DB;

class Stock implements \JsonSerializable
{
	/**
	 * catch the stock query
	 */
    protected $stock;
    /**
     * catch the stockdenominations
     */

    protected $denominations;

    /**
     * fetchs the stock loads on  a specific date
     *
     * @param      string  $date   
     *
     * @return     self  
     */
    public function daily($date=null)
    {
        $date=$date?:date("Y-m-d");

        $this->stock=BaseStock::whereDate("date", $date)->pluck("stock_id");

        return $this;
    }


    public function range($dates)
    {
    }
    /**
     * calculate the net total of the entire stocl
     *
     * @return     integer  
     */
    public function net()
    {
        return $this->getDenominations()->sum("net");
 
    }

    public function grossTotalSeries()
    {
    	return $this->networks()->map(function ($network){

    	});
    }


   /**
    * group the denominations by the given networks
    *
    * @return     Illuminate\Support\Collection
    */
    public function networks()
    {
        return $this->getDenominations()->groupBy("network");
    }

    public function networkTotals()
    {
    	return $this->networks()->map(function ($denominations){
    		$gross=$denominations->sum("gross");
    		$net=$denominations->sum("net");

    	    return compact("gross","net");
    	});
    }
    /**
     * the number of items in the collection
     *
     * @return     integer
     */
    public function count()
    {
        return $this->stock->count();
    }

    /**
     * Gets the denominations.
     *
     * @return     Illuminate\Support\Collection
     */
    public function getDenominations()
    {
        if ($this->denominations) {
            return $this->denominations;
        }
   
  
        $this->denominations=$this->denominationsQuery();

        return $this->denominations;
    }

    /**
     * the query for fetching denominations
     *
     * @return     Illuminate\Database\Eloquent\BaseCollection  
     */
    public function denominationsQuery()
    {
        return Denomination
        ::whereIn("stock_id",$this->stock)
        ->select("network", "weight",
        DB::raw("sum(net) as net ,sum(gross) as gross")
        )->groupBy("network", "weight")
        ->get();
    }
    /**
     * convert the object to a json
     *
     * @return     array  
     */
    public function jsonSerialize()
    {
    	return [
    		"total_count"=>$this->count(),
    		"grossTotalSeries"=>$this->grossTotalSeries(),
    		"net" => $this->net(),
    		"networks"=>$this->networks(),
    		"networkTotals"=>$this->networkTotals(),
    	];
    }

}
