<?php

namespace App;

use App\Stock\Calculator;
use App\Stock\DenominationMaker;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public $timestamps=false;
    
    /**
     * convert these fields fromjson to array
     *
     * @var        array
     */
    protected $casts=[ "loading"=>"array","stock"=>"array"];
 
   
    /**
     * Gets the denominations attribute.
     *
     * @return     App\Stock\DenominationMaker
     */

    public function getDenominationsAttribute()
    {
         return (new Calculator($this->stock, $this->loading));
    }
    /**
     * opens the stock for manipulaion
     *
     * @return     self
     */
    public static function open()
    {
        return static::first();
    }
    /**
     * adds stock to the store
     *
     * @param      array  $additions
     *
     * @return     array
     */
    public function add($additions)
    {
        $new=$this->manipulateStock($additions, "increase");

        return $this->persistChanges($additions, $new);
    }
    /**
     * remove some stock from the store
     *
     * @param      arrau  $deductions
     */
    public function subtract($deductions)
    {
       $new=$this->manipulateStock($deductions, "decrease");

        return $this->persistChanges($deductions, $new);
    }
    /**
     * manipulate the stock and computes the would be avaialable stock
     *
     * @param      as        $new
     * @param
     *
     * @return
     */
    public function manipulateStock($new, $manipulator)
    {
        $present=$this->stock;

        foreach ($new as $network=>$denominations) {
            foreach ($denominations as $weight=>$quantity) {
                $this->$manipulator($present, $network, $weight, $quantity);
            }
        }

        return $present;
    }
    /**
     * increase a specific network denomination in the store
     *
     * @param      array   $present   The present
     * @param      strin   $network
     * @param      integer   $weight
     * @param      integer  $quantity
     */
    public function increase(&$present, $network, $weight, $quantity)
    {
        $present[$network][$weight]+=$quantity;
    }
    /**
     * decrease a specific denomination from the store
     *
     * @param      array    $present
     * @param      string   $network
     * @param      integer   $weight
     * @param      integer  $quantity
     */
    public function decrease(&$present, $network, $weight, $quantity)
    {
        $present[$network][$weight]-=$quantity;
        unset($present);
    }
    /**
     * persist any changes that may have been persisted throught the process
     *
     * @param      array  $changes
     *
     * @param      array $new
     *
     * @return     array
     */
    public function persistChanges($changes, $new)
    {
        $this->stock=$new;

        $before=$this->stockDifference($changes, $this->fresh()->stock);

        $after=$this->stockDifference($changes, $this->stock);

        $this->save();
        
        return compact("before", "after");
    }
    /**
     * get the intersection of two stock arrays
     *
     * @param      array $newStock  The new stock
     * @param      array  $oldStock  The old stock
     *
     * @return     array
     */
    public function stockDifference($newStock, $oldStock)
    {
        foreach ($newStock as $network=>$denominations) {
            $differences[$network]=
                (array_intersect_key($oldStock[$network], $denominations));
        }

        return $differences;
    }
    /**
     * get the current store loading
     *
     * @return     array  
     */
    public static function loading()
    {
        return Cache::rememberForever("store.loading", function () {
            return static::first()->loading;
        });
    }
}
