<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denomination extends Model
{
    const NAMES=[

    "HALF_K"=>500,
    "ONE_K"=>1000,
    "TWO_K"=>2000,
    "FIVE_K"=>5000,
    "TEN_K"=>10000,
    "TWENTY_K"=>20000
    ];
    /**
     * appends to this model
     *
     * @var        array
     */
  protected $appends=["new_quantity"];
    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=["weight","quantity","network_id","percentage"];
    
    /**
     * a denomination belongs to a netwrok
     *
     * @return     \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function network()
    {
        return $this->belongsTo(Network::class, "network_id", "network_id");
    }

    /**
     * Gets the before quantity attribute.
     *
     * @param      integer  $quantity
     *
     * @return     App\DenominationQuantity
     */
    public function getBeforeQuantityAttribute($quantity)
    {
        return $this->asQuantified($quantity);
    }
    /**
     * Gets the new quantity attribute.
     *
     * @param      integer  $quantity  The quantity
     *
     * @return     App\DenominationQuantity
     */
    public function getNewQuantityAttribute($quantity)
    {
        return $this->asQuantified($quantity);
    }
    /**
     * Gets the after quantity attribute.
     *
     * @param      integer  $quantity  The quantity
     *
     * @return     App\DenominationQuantity
     */
    public function getAfterQuantityAttribute($quantity)
    {
        return $this->asQuantified($quantity);
    }
    /**
     * wrap the primtive quantity into an intuituve class
     *
     * @param      integer                $quantity
     *
     * @return     App\DenominationQuantity
     */
    protected function asQuantified($quantity)
    {
        return new DenominationQuantity($quantity, $this->weight, $this->network->percentage);
    }
    /**
     * Gets the name attribute of the denomination.
     *
     * @return     strin  The name attribute.
     */
    public function getNameAttribute()
    {
        return $this->name($this->weight);
    }
    /**
     * gets the network name of the denomination
     *
     * @return     string
     */
    public function networkName()
    {

        return sprintf("%s %s", $this->network->name, $this->name);
    }
    /**
     * gets the name of the denomination in the look up array
     *
     * @param      integer  $denomination  The denomination
     *
     * @return     string  name
     */
    public static function name($denomination)
    {
        return array_flip(static::NAMES)[$denomination];
    }

    /**
     * gets the denomiantions that were loaded with it
     *
     * @param      Network $network
     *
     * @return     Illuminate\Database\Eloquent\Collection
     */
    public static function fellow(Denomination $denomination)
    {
        $denomination->network->load(["denominations.network","denominations.serial"]);

        return $denomination->network->denominations;
        
    }
    /**
     * Gets the pieces attribute.
     *
     *  alias for new quantity
     *  p
     * @return     integer  The pieces attribute.
     */
    public function getPiecesAttribute()
    {
        return $this->new_quantity->quantity;
    }
    /**
     * a denomination may have  a serial number
     *
     * @return     Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function serial()
    {
        return $this->hasOne(Serial::class, "denomination_id");
    }
}
