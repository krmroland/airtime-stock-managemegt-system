<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * turn off the timestamps
     *
     * @var        boolean
     */
    public $timestamps=false;
    /**
     * date fields
     *
     * @var        array
     */
    protected $dates=["date"];
    /**
     * appends these accessors
     *
     * @var        array
     */
    protected $appends=["type","transactionNumber","formatedDate","detailUrl"];

    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=[
    "date","transactable_type","transactable_id","description","ammount"
    ];

    /**
     * The transaction types
     *
     * @var        array
     */
    protected $types=[
    "stock"=>"App\\Stock",
    "payment" =>"App\\Payment",

    ];
    /**
     * record a transaction
     *
     * @param      Illuminate\Database\Eloquent\Model  $model        
     * @param      integer  $ammount      
     * @param      string  $description  
     *
     * @return     self  
     */
    public static function record($model, $ammount, $description)
    {
        return  static::create([
                "date"=>$model->date,
                "transactable_type"=>get_class($model),
                "transactable_id"=>$model->getKey(),
                "description"=>$description,
                "ammount"=>$ammount

            ]);
    }
    /**
     * compile the transactions
     *
     * @param      string  $type   
     *
     * @return     Illuminate\Pagination\AbstractPaginator
     */
    public function compile($type=null)
    {
        $query=$this->latest("date");
        
        $type=$this->parseType($type);

        if ($type) {
            $query=$query->where("transactable_type", $type);
        }

        return $query;
    }
    /**
     * parse the type of transactions being queried
     *
     * @param      string  $type   The type
     *
     * @return     mixed  
     */
    protected function parseType($type=null)
    {
        if (array_has($this->types, $type)) {
            return $this->types[$type];
        }

        return false;
    }
    /**
     * The  model that is responsible for transaction
     *
     * @return     Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function transactable()
    {
        return $this->morphTo();
    }

    /**
     * a fielder has a transaation
     *
     * @return     Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function balance()
    {
        return $this->hasOne(FielderBalance::class);
    }

    /**
     * Gets the type attribute.
     *
     * @return     string  The type attribute.
     */
    public function getTypeAttribute()
    {

        if ($this->description=="issued_stock") {
            return "Stock";
        }
        if ($this->description=="purchased_stock") {

            return "Purchase";
        }

        return explode("App\\",$this->transactable_type)[1];

    }

    public function getTransactionNumberAttribute()
    {
        return "Trans-".str_pad($this->id,6,0,STR_PAD_LEFT);
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
        return route("transactions.show",["id"=>$this->id]);

    }

    public function compiled()
    {
        $description=$this->description;

        if ($description=="issued_stock") {
            return $this->load(
                "transactable.loaded.fielder",
                "transactable.networks.denominations.serial",
                "transactable.networks.denominations.network"
            );
        }

        if ($description=="made_payment") {

            return $this->load("transactable.fielder");
        }

        if ($description=="purchased_stock") {
           return  $this->load(
                "transactable.networks.denominations.network"
            );

           //if we get to this point, it means we diddnt eager load some type
           dd("You didnt eager load this mr developer Transaction.php line 184");
        }
    }

    public function getStatusTypeAttribute()
    {
        return ($this->ammount<0)?"debt":"credit";

    }

    public function scopeSearch($builder,$request)
    {
            return $builder->whereDate("date","like","%$request->filter%")
                   ->latest("date");  
    }
}
