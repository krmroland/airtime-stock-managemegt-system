<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
	/**
	 * turn off the timestamps
	 *
	 * @var        boolean
	 */
	public $timestamps=false;
   /**
    * @var casts
    */
   protected $casts=["processed_ids"=>"array"];

   /**
    * unique indentifier
    * @var string
    */
   protected $primaryKey="saving_id";
   
}
