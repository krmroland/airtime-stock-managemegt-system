<?php

namespace App\Stock;

use App\Store;

use App\Stock\Processor;

use Illuminate\Support\Facades\DB;


class Purchasing extends Processor
{
    
    public function handle()
    {
       DB::transaction(function (){
           $this->process();
       });
    }
    /**
     * Gets the percentages used to purchse the stock from the store
     *
     * @return     array  The percentages.
     */
    public function loading($network=null)
    {
        $loading=Store::loading();
        
        return $network?$loading[$network]:$loading;
 
    }


    public function storeMethod()
    {
        return "add";
    }

    public function description()
    {
        return "purchased_stock";
    }

    public function  saving($network=null)
    {
        return null;
    }

}
