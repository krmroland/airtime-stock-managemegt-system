<?php

namespace App\Stock;

use App\Stock\Saver;

use Illuminate\Support\Facades\DB;

class Processor
{
    protected $stock;


    public function __construct(Saver $saved)
    {

        $this->stock= $saved->stock();
        
    }

    /**
     * hadle the job
     */
    public function handle()
    {
        DB::transaction(function () {
            foreach ($this->processors() as $processor) {
                app($processor)->process($this->stock);
            }
        });
    }

    protected function processors()
    {
        return [
        \App\Stock\Processors\NetworkProcessor::class,
        \App\Stock\Processors\DenominationsProcessor::class,
        \App\Stock\Processors\SerialsProcessor::class,
        \App\Stock\Processors\TransactionsProcessor::class,

        ];
    }
}
