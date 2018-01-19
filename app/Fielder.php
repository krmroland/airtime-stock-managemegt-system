<?php

namespace App;

use App\Services\Image;

use Illuminate\Database\Eloquent\Model;

class Fielder extends Model
{
    /**
     * unique indentifier
     * @var string
     */
    protected $primaryKey="fielder_id";
    /**
     * append these attributes when the modelis serialized
     *
     * @var        array
     */
    protected $appends=["imagePath"];

    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=["name","phoneNumber","saving","loading"];

    /**
     * cast these fields from json to arrays and vice versa
     */
    protected $casts =["loading"=>"array","saving" => "array"];

    /**
     * Gets the image attribute.
     *
     * @return     \App\Services\Image  The image attribute.
     */
    public function getImagePathAttribute()
    {
    	return new Image("fielders", "$this->fielder_id.jpg");
    }
     /**
      * search the fielder instance
      *
      * @param      Illuminate\Database\Eloquent\Builder  $builder  
      * @param      string  $queryString   
      *
      * @return     Illuminate\Database\Eloquent\Builder  
      */	
     public function scopeSearch($builder, $queryString)
     {
     	return $builder->where("name","like","%$queryString%")
                      ->orwhere("phoneNumber","like","%$queryString%")->limit(10);
     }
     /**
      * a fielder has many transactions
      *
      * @return     \Illuminate\Database\Eloquent\Relations\HasMany
      */
     public function transactions()
     {
       return $this->hasMany(FielderTransaction::class,"fielder_id","fielder_id");
     }
     /**
      * update the fielders balace
      *
      * @param      \App\Transaction  $transaction  
      */
    public function updateBalance(Transaction $transaction)
    {
      $this->balance+=$transaction->ammount;

        $this->transactions()->create([
            "transaction_id"=>$transaction->id,
            "before"=>$this->fresh()->balance,
            "after"=>$this->balance,
        ]);

        $this->save();
    }
    /**
     * compile the fielders transactions
     *
     * @return     \Illuminate\Pagination\AbstractPaginator
     */
    public function  compileTransactions()
    {
        return $this->transactions()->with(["originalTransaction"=>function($query){
            return $query->latest("date");
        }])->paginate(40);
    }

    public function paidSavings()
    {
        return $this->hasMany(PaySaving::class,"fielder_id","fielder_id");
    }

    public function savings()
    {
        return $this->hasMany(Saving::class,"fielder_id","fielder_id");
    }
    
}
