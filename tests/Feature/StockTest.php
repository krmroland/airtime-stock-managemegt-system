<?php

namespace Tests\Feature;


use App\Loading;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StockTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     * 
     * @return void
     */
    public function it_converts_the_date_issued_to_a_time_stamp()
    {

       $stock=new Loading(["date"=>date("d-m-Y")]);

       $this->assertEquals($stock->date->format("Y-m-d"), date("Y-m-d"));
    }

    
}
