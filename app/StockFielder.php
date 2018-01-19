<?php

namespace App;


class StockFielder extends Stock
{
    public $timestamps=false;

    protected $fillable=["fielder_id","stock_id"];
    
    public function fielder()
    {
    	return $this->belongsTo(Fielder::class,"fielder_id","fielder_id")
    				->select("name","fielder_id","phoneNumber","balance");
    }


    
   
}
