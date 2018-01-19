<?php

namespace App;

use App\Stock\DenominationMaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

    /**
     * the stock related denominations
     *
     * @var        array
     */
    const DENOMINATIONS=[

    "HALF_K"=>500,
    "ONE_K"=>1000,
    "TWO_K"=>2000,
    "FIVE_K"=>5000,
    "TEN_K"=>10000,
    "TWENTY_K"=>20000
    ];

    /**
     * unique indentifier
     * @var string
     */
    protected $primaryKey="stock_id";
    /**
     * treat these fields as dates
     *
     * @var        array
     */
    protected $dates=["date"];

    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=["date","description","net"];

  /**
   * get the denominations name
   *
   * @param      string  $denomination  
   *
   * @return     string  
   */

    public static function denominationName($denomination)
    {
        return array_flip(static::DENOMINATIONS)[$denomination];
    }
    /**
     * stock can be loaded bya fielder
     *
     * @return     Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function loaded()
    {
        return $this->hasOne(StockFielder::class, "stock_id");
    }

    
    /**
     * stock is composed of networks
     *
     * @return     Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function networks()
    {
        return $this->hasMany(Network::class, "stock_id", "stock_id");
    }

    public function monetary()
    {
        if ($this->description=="issued_stock") {
            return $this->net*-1;
        }
        return $this->net;
    }

    public static function today()
    {
        return static::whereDate("date",date("Y-m-d"))
                        ->with(["loaded","networks.denominations.network"])
                        ->get();
    }    

}
