<?php

namespace App\Stock;

use Closure;

use App\DenominationQuantity;

class Calculator implements \IteratorAggregate
{
    protected $raw;

    protected $percentages;

    protected $items=[];

    protected $netTotals=[];

    protected $grandTotals=[];

    public function __construct($raw=[], $percentages=[])
    {
        $this->setPercentages($percentages);

        $this->makeItems($raw);
    }


    /**
     * makes and sets the value of items.
     *
     * @param array $raw the items
     *
     * @return self
     */
    protected function makeItems($raw)
    {
        $this->loop($raw, function ($network, $weight, $quantity) {
            $this->items[$network][$weight]=$this->wrapItem($network, $quantity, $weight);
        });
    }

    /**
     * wraps the item inot the denomination class
     *
     * @param      string                $network   The network
     * @param      integer                $quantity  The quantity
     * @param      float                $weight
     *
     * @return     \App\DenominationQuantity
     */
    protected function wrapItem($network, $quantity, $weight)
    {
        return (new DenominationQuantity(
                $quantity,
                $weight,
                $this->getPercentage($network))
            );
    }

    protected function getPercentage($network)
    {
        //dd($this->percentages);

        return $this->percentages[$network];
    }

    public function networks()
    {
        return array_keys($this->items);
    }

    public function netTotals()
    {
        if (empty($this->netTotals)) {
            $this->setNetTotals();
        }

        return $this->netTotals;
    }

    public function netTotal($network=null)
    {
       return $this->summer($this->netTotals(),$network);
    }
    public function grossTotal($network)
    {
       return $this->summer($this->grossTotals(),$network);
    }

    public function grossTotals()
    {
        if (empty($this->grossTotals)) {
            $this->setGrossTotals();
        }

        return $this->grossTotals;
    }

    protected function summer($totals=[],$network=null)
    {
        $totals=isset($totals[$network])?$totals[$network]:$totals;

        return  collect($totals)->map(function ($network){
            return collect($network)->sum();
        })->sum();

    }

    public function loop($loopable, Closure $closure)
    {
        foreach ($loopable as $network =>$denominations) {
            foreach ($denominations as $weight=>$quantity) {
                $closure($network, $weight, $quantity);
            }
        }
    }
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
    /**
     * Sets the gross totals.
     *
     * @return     self  
     */
    protected function setGrossTotals()
    {
        $this->loop($this->items, function ($network, $weight, $denomination) {
            $this->grossTotals[$network][$weight]=$denomination->gross;
        });

        return $this;
    }

    /**
     * Sets the value of netTotals.
     *
     * @return self
     */
    protected function setNetTotals()
    {
        $this->loop($this->items, function ($network, $weight, $denomination) {
            $this->netTotals[$network][$weight]=$denomination->net;
        });

        return $this;
    }

    /**
     * @param mixed $percentages
     *
     * @return self
     */
    public function setPercentages($percentages)
    {
        $this->percentages = $percentages;

        return $this;
    }
    /**
     * @param mixed $items
     *
     * @return self
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }
}
