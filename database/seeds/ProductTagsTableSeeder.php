<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductTagsTableSeeder extends Seeder {
    /**
     * Run the product_tags table seeds.
     *
     * @return void
     */
    public function run() {
        $faker 			= Faker::create();
        $seederQuantity = (int)Config::get('app.seeder_quantity');
		
        for ($i = 0; $i < $seederQuantity * 2; $i++) {
            DB::table('product_tags')->insert([
				'created_at' => $faker->dateTimeBetween('-4 months', '-3 month'),
				'updated_at' => $faker->dateTimeBetween('-2 months', '-1 month'),
			]);
        }
    }
}