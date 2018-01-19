<?php

use App\Stock;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Fielder::class, function (Faker\Generator $faker) {
    static $password;
    $networks=collect(config("app.networks"))->flip();

    return [
        'name' => $faker->name,
           'phoneNumber'=>$faker->bothify("07########"),
        'saving'=>$networks->map(function ($name, $key) {
            return 0.5;
        })->toArray(),

        "loading"=>$networks->map(function ($name, $key) {
            return 7;
        })->toArray()
    ];
});

$factory->define(App\Stock::class, function (Faker\Generator $faker) {
    return [
        'date' => $faker->date,
        'fielder_id'=>App\Fielder::pluck("fielder_id")->random()
        
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Denomination::class, function (Faker\Generator $faker) {
    static $password;

    $raw= collect(config("app.networks"))->flip()->map(function($network)use($faker){
               return  collect(App\Stock::DENOMINATIONS)->take($faker->numberBetween(2,6))
                        ->flip()->map(function ()use($faker){
                    return $faker->numberBetween(2,250);
                });
        })->toArray();

    return Stock::find(rand(1,Stock::count()))->storeDenominations(json_encode($raw));
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Statement::class, function (Faker\Generator $faker) {
    $date=$faker->unique()->dateTimeThisCentury;
    return [
        'month' => $date->format("m"),
        'year' => $date->format("Y"),
        'name'=>"Financial Statement for ".$date->format("Y")."  ".$date->format("m"),
        'path'=>"/storage/name.pdf"
    ];
});
