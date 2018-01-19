<?php

namespace App\Stock\Processors;

use App\Store;
use App\Stock\Process;

class StoreProcessor
{
    /**
     * the stock related Process
     *  @var Process
     */
    protected $process;
    /**
     * the store
     * @var App\Store
     */
    protected $store;

    protected $state=[];


    public function __construct(Store $store)
    {
        $this->process=app("stockProcess");;

        $this->store=$store;

        $this->process();
    }
    /**
     * process this operation
     *
     * @return     array
     */
    public function process()
    {
        if ($this->process->isLoading()) {
            $this->state=$this->store->open()->subtract($this->process->quantities());

        }
        if ($this->process->isPurchasing()) {
            $this->state= $this->store->open()->add($this->process->quantities());
        }

        return [];
    }

    public function before($network,$weight)
    {
    	return $this->state["before"][$network][$weight];
    }

    public function after($network,$weight)
    {
    	return $this->state["after"][$network][$weight];
    }
}
