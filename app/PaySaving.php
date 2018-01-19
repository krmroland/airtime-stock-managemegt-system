<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaySaving extends Model
{	
	/**
	 * turn off the timestamps
	 *
	 * @var        boolean
	 */
    public $timestamps=false;
    /**
     * casts these fields to and from arrays
     *
     * @var        array
     */
    protected $catsts=["paid_ids"=>"array"];
}
