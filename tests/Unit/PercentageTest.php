<?php

namespace Tests\Unit;

use App\Percentage;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PercentageTest extends TestCase
{
    /**
     * @test
     */
    function it_discounts_a_raw_value()
    {
    	$percentage =new Percentage("mtn",5);

    	$this->assertEquals($percentage->discounted(), 0.95);
    }
    /**
     * @test
     */
    function it_converts_a_raw_value_to_a_flat_percentage()
    {
    	$percentage =new Percentage("mtn",5);

    	$this->assertEquals($percentage->flat(), 5/100);
    }
}
