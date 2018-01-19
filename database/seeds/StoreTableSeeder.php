<?php

use App\Stock;
use App\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreTableSeeder extends Seeder
{
	public function run()
	{
		$raw=$this->prepareRaw();
		$store = new Store;
		$store->loading=$raw["loading"];
		$store->stock=$raw["stock"];

		$store->save();
	}

	public function prepareRaw()
	{
		$raw=[];
		foreach (config("app.networks") as $network) {
			$raw["loading"][$network]=7;
			foreach (Stock::DENOMINATIONS as  $weight) {
				$raw["stock"][$network][$weight]=0;
				
			}
		}
		return $raw;
	}
}