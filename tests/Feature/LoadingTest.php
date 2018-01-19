<?php

namespace Tests\Feature;

use App\Fielder;
use App\Loading;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoadingTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * sets the percentages based on the loading fielder
     *
     * @test
     * @return void
     */
    public function it_sets_the_fielder_percentages_on_the_stock_instance()
    {
        $fielder=$this->createFielder();

        $stock= new Loading(["fielder_id"=>$fielder->getKey()]);

        $this->assertEquals(array_keys($fielder->loading), $stock->percentages->keys()->toArray());
    }
    /**
     * @test
     */
    public function it_updates_the_fielders_balance_on_creation_of_a_new_fielder()
    {
        factory(Fielder::class,10)->create();
        $stock=factory(Loading::class)->create();
       
        $fielder=$stock->fielder;

        $this->assertEquals($fielder->balance, $stock->monetary());
    }

    // /**
    //  * @test
    //  */
    // public function it_updates_the_balance_of_an_existing_fielder()
    // {
    //     $fielder=$this->createFielder();

    //     $balance=rand(-10000,-100000);

    //     $fielder->balance=$balance;

    //     $fielder->save();

    
    //     $stock=factory(Loading::class)->make();

    //     $stock->fielder_id=$fielder->fielder_id;
    //     $stock->save();
    //     dd($stock);
    //     $this->assertEquals($fielder->balance,$balance-$stock->monetary());

    // }

    protected function createFielder()
    {
        return factory(Fielder::class)->create();
    }
}
