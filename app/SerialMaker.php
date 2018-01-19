<?php

namespace App;

class SerialMaker implements \JsonSerializable
{
    protected $serials=[];

    /**
     * creates an instance of the make class
     *
     * @param      Illuminate\Database\Eloquent\Collection  $serials
     */
    public function __construct($serialRange)
    {
        $this->setSerials($serialRange);
    }
    
    /**
     * @param mixed $serials
     *
     * @return self
     */
    public function setSerials($serialRange)
    {
    	if (!$serialRange) {
    		return;
    	}

        for ($i = $serialRange->from; $i <=$serialRange->to; $i++) {

            $serial["denomination_id"]=$serialRange->denomination_id;
  
            $serial["denomination_name"]=$serialRange->denomination->networkName();

            $serial["serial"]=$i;

            $serials[]=$serial;
        }

        $this->serials=$serials;
    }
    
    /**
     * serial this object to json
     *
     * @return     Illuminate\Support\Collection
     */
    public function jsonSerialize()
    {
        return collect($this->serials)->where("serial", request("serial"));
    }
}
