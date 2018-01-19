<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (["users","stores","fielders"] as $table) {
            DB::table($table)->truncate();
        }
        $this->call(UsersTableSeeder::class);
        $this->call(StoreTableSeeder::class);
        factory(App\Fielder::class,10)->create();
    }
}
