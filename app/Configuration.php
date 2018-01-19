<?php

namespace App;


use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Storage;



class Configuration
{

    /**
     * get all the configuration
     *
     * @return     Collection  
     */
    public static function all()
    {
        return Cache::rememberForever("configuration.all",function (){
            return collect(json_decode(Storage::get("defaults.json"),true));
        });
    	
    }
    /**
     * update the current configuration
     *
     * @param      array  $attributes  
     */
    public static function update(array $attributes)
    {
    	Cache::flush();
    	Storage::put("defaults.json",json_encode($attributes));
        return static::all();
    }
    
    public function __get($name)
    {
        return $this->all()[$name];
    }

    public function __toString()
    {
        return $this->all()->toJson();
    }
    public function percentages()
    {

        return collect($this->all()["purchasing_percentages"]);
    }
   
}
