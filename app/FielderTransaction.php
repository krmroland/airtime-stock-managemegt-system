<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FielderTransaction extends Model
{
    protected $dates=["date"];
    /**
     * Turn off the timestamps for this model
     *
     * @var        boolean
     */
    public $timestamps=false;
    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=[
    	"fielder_id","before","after","transaction_id","transaction_type","description","date"
    	];
    public function fielder()
    {
    	return $this->belongsTo(Fielder::class,"fielder_id","fielder_id");
    }

    public function originalTransaction()
    {
    	return $this->belongsTo(Transaction::class,"transaction_id");
    }
}
