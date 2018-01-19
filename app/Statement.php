<?php

namespace App;

use Carbon\Carbon;
use App\Services\Path;
use App\Statements\Generator;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    
    protected $formedDate;
    /**
     * turn off the timestamps
     *
     * @var        boolean
     */
    public $timestamps=false;

    /**
     * locates a report form based on its month and year
     *
     * @param      string  $date   
     *
     * @return     self  
     */
    public static function locate($date)
    {
        return (new static)->setProperties($date)->existing();
    }
    /**
     * verify if the statement exists and return it if so
     *
     * @return   Self
     */
    protected function existing()
    {
        return $this->where(
                        ["month"=>$this->month],
                        ["year"=>$this->year]
                    )->first()?:$this;
    }

    /**
     * parse a fate string
     *
     * @param      strin  $date   The date
     *
     * @return     \Carbon\Carbon
     */
    public function parseDate($date)
    {
        return Carbon::createFromFormat("F,Y", $date);
    }

    /**
     * generates a report form and store it in storage      
     *
     * @return     Self
     */
    public function generate()
    {
        $generated=$this->generator()->storePdf();

        return $generated? $this->save():false;
    }

    /**
     * Sets the properties.
     *
     * @param      string  $date   
     *
     * @return     self  
     */
    public function setProperties($date)
    {

        $date=$this->parseDate($date);
        
        $this->month=(int)$date->format("m");
        
        $this->year=(int)$date->format("Y");

        return $this->setName($date)->setPath();
    }
    /**
     * Sets the name.
     *
     * @param      Carbon\Carbon  $date   
     *
     * @return     self  
     */

    public function setName($date)
    {
        $this->name=sprintf("(%s to %s %s %s)",
            $date->startOfMonth()->format("jS"),
            $date->endOfMonth()->format("jS"),
            $date->format("F"),
            $date->format("Y")
        );
        return $this;
    }
    /**
     * Sets the path.
     *
     * @return     self  
     */
    public function setPath()
    {
        $this->path=$this->path()->url();

        return $this;
    }
    /**
     * The path instance
     *
     * @return     App\Services\Path
     */
    public function path()
    {
         $name=str_slug($this->name).".pdf";

        return new Path("statements",$name);
    }
    /**
     * check to see if this staetemnt is persisted in the database
     *
     * @return     boolean 
     */
    public function alreadyExists()
    {
        return !!($this->fresh());
    }
    /**
     * the generator instance
     *
     * @return     \App\Statements\Generator
     */
    protected function generator()
    {
        return new Generator($this);
    }

    /**
     * stream line this statement
     *
     * @return     Illuminate\Http\Response
     */
    public function stream()
    {
        return $this->generator()->stream();
    }
    
    public function recompile()
    {
        return $this->generate();
    }

    public function delete()
    {
        $this->generator()->delete();

        parent::delete();
    }

    public function getMonth()
    {
      return str_pad($this->month, 2,0, STR_PAD_LEFT);
    }
}
