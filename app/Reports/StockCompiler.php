<?php

namespace App\Reports;

use App\Denomination;
use App\Reports\Stock;
use Illuminate\Http\Request;

class StockCompiler
{
    protected $beforeQuantities=[];

    protected $newQuantities=[];

    protected $afterQuantities=[];


    protected $data=[
    "loaded"=>[],
    "purchased"=>[],
    "opening"=>[],
    "closing"=>[],
    ];
    
    public function __construct($collection)
    {
        $this->setProperties($collection);
    }

    /**
     * Sets the properties.
     *
     * @param      Illuminate\Support\Collection  $collection 
     *
     * @return     self
     */
    public function setProperties($collection)
    {
        $this->setLoaded($collection->where("description", "issued_stock"))
        ->setPurchased($collection->where("description", "purchased_stock"))
        ->setStates($collection)
        ->setPieData();
        return $this;
    }
    


    /**
     * @param mixed      * @return self
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @param mixed $purchased
     *
     * @return self
     */
    public function setPurchased($purchased)
    {
        $purchased->groupBy("name")->map(function ($data, $network) {
            $data->groupBY("weight")->map(function ($data, $weight) use ($network) {
                $this->data["purchased"][$network]["table"][$weight]
                =$this->quantify([$weight=>$data->sum("new_quantity")]);
            });
        });

        return $this;
    }

    /**
     *
     * @return self
     */
    public function setStates($collection)
    {
        $collection->groupBy("name")->map(function ($data, $network) {
            $data->groupBY("weight")->map(function ($data, $weight) use ($network) {
                $data->map(function ($data) {
                    $this->beforeQuantities[$data->name][$data->weight][]=
                    $data->before_quantity;
                    $this->afterQuantities[$data->name][$data->weight][]=
                    $data->after_quantity;
                });
            });
        });


        foreach ($this->beforeQuantities as $network=>$denominations) {
            foreach ($denominations as $weight=>$changes) {
                $before=array_first(array_diff($changes, $this->afterQuantities[$network][$weight]));

                $this->data["opening"][$network]["table"][$weight]=
                $this->quantify([$weight=>$before]);

                $closing=array_first(array_diff($this->afterQuantities[$network][$weight], $changes));
                $this->data["closing"][$network]["table"][$weight]=

                $this->quantify([$weight=>$closing]);
            }
        }
        return $this;
    }


    /**
     * @param mixed $loaded
     *
     * @return self
     */
    public function setLoaded($loaded)
    {
        $loaded->groupBy("name")->map(function ($data, $network) {
            $data->groupBY("weight")->map(function ($data, $weight) use ($network) {
                $this->data["loaded"][$network]["table"][$weight]=
                $this->quantify([$weight=>$data->sum("new_quantity")]);
            });
        });

        return $this;
    }

    public function setPieData()
    {
        foreach ($this->data as $item=>$network) {
            foreach ($network as $name=>$data) {
                $this->data[$item][$name]["pie"]=$this->makePieData($data["table"]);
            }
        }
    }
    public function data()
    {
        return collect($this->data);
    }

    protected function quantify(array $data)
    {

        return ["quantity"=>current($data), "gross"=>key($data)*current($data)];
    }

    public function makePieData($denominations)
    {
        return collect($denominations)->map(function ($quantified, $weight) {
            return [
                "name"=>Denomination::name($weight),
                "y"=>intval($quantified["gross"])>0?$quantified["gross"]:0
            ];
        })->values();
    }
}
