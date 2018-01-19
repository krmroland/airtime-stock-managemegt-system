<?php

namespace Tests\Feature;

use App\Percentage;
use Tests\TestCase;
use App\Stock\Denomination;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DenominationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * 
     * @test
     */
    function it_calculates_the_gross()
    {
       
       $percentage = new Percentage("mtn", 5);

       $denomination = new Denomination(500,2,$percentage);

       $this->assertEquals($denomination->gross(),1000);

    }
    /**
     * @test
     * it_calculates_the_net
     */
    function it_calculates_the_net()
    {
    	$percentage = new Percentage("mtn", 5);

    	$denomination = new Denomination(500,20,$percentage);
     
    	$this->assertEquals($denomination->net(), 9500);

    }
}
