<?php

namespace App;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{

	/**
	 * unique indentifier
	 * @var string
	 */
	protected $primaryKey="denomination_id";

    public $timestamps=false;
    /**
     * Searches for the first match.
     *
     * @param      integer       $serial  The serial
     *
     * @return     \App\SerialMaker
     */
    public static function search($serial)
    {
    	$serial=intval($serial);

     $serials=static::where([
    			["from","<=",$serial],
    			["to",">=",$serial]
    		])->with("denomination.network")->first();
    	
    	return new SerialMaker($serials);
    }
    /**
     * a serial number belongs to a adenomination
     *
     * @return     Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function denomination()
    {
    	return $this->belongsTo(Denomination::class);
    }

    public function getRangeAttribute()
    {
        return "($this->from to $this->to)";
    }
}
