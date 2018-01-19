<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	public function run()
	{
		 DB::table("users")->insert([
            "name"=>"Ahimbisibwe Roland",
            "email"=>"airtime@lawma.ug",
            "password"=>bcrypt("secret")
            ]);
	}
}
