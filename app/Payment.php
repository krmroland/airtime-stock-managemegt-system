<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $appends=["formatedDate","detailUrl"];
    
    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=["date","ammount","fielder_id"];

    /**
     * the date fields on this instance
     *
     * @var        array
     */
    protected $dates=["date"];

    /**
     * the monetary value of the payment
     *
     * @return     integer
     */
    public function monetary()
    {
        return $this->ammount;
    }
    /**
     * the net value of a payment
     *
     * @return     integer
     */
    public function net()
    {
        return $this->ammount;
    }

    /**
     * A payment is made by  a fielder
     *
     * @return     Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fielder()
    {
        return $this->belongsTo(Fielder::class, "fielder_id", "fielder_id");
    }

    public static function make($data)
    {
        return (new static)->create($data)->process();
    }

    protected function process()
    {
        $transaction=Transaction::record($this, $this->ammount, "made_payment");

        $this->fielder->updateBalance($transaction);
        
        return $this;
    }


    public function getFormatedDateAttribute()
    {
        return $this->date->format("d-F-Y");
    }
  /**
   * Gets the detail url attribute.
   *
   * @return     string  The detail url attribute.
   */
  public function getDetailUrlAttribute()
  {
     return route("payments.show", ["id"=>$this->id]);

  }

  public function scopeSearch($builder,$request)
  {
    

    return $builder->whereDate("date","like","%$request->filter%")
                 ->with("fielder")->latest("date");  
  }


}
