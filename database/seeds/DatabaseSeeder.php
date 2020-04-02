<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $seederQuantity = (int)Config::get('app.seeder_quantity');

        factory('App\Models\Product', $seederQuantity)->create();
        factory('App\Models\ProductTag', $seederQuantity * 2)->create();
		
        $this->call([
			LanguagesTableSeeder::class,
			ProductTranslationsTableSeeder::class,
			ProductTagTranslationsTableSeeder::class,
			ProductsProductTagsTableSeeder::class
		]);
    }
}
