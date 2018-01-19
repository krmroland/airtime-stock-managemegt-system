<?php

namespace App\Stock\Processors;

use App\Transaction;


class TransactionsProcessor
{
    protected $process;


    public function __construct()
    {
        $this->process =app("stockProcess");

    }

    public function process($stock)
    {
        $transaction=$this->record($stock);
       
        if ($this->process->isLoading()) {
            $this->process->fielder()->updateBalance($transaction);
        }
    }

    protected function record($stock)
    {
      return 
      Transaction::record($stock,$stock->monetary(),$stock->description);

    }
}
