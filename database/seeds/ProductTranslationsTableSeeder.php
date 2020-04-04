<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use App\Models\Product;
use App\Models\Language;

class ProductTranslationsTableSeeder extends Seeder {
    /**
     * Run the product_translations table seeds.
     *
     * @return void
     */
    public function run() {
        $faker 		= Faker::create();
        $products 	= Product::all();
        $languages 	= Language::all();
		
        foreach ($products as $product) {
            foreach ($languages as $language) {
                DB::table('product_translations')->insert([
					'product_id' 	=> $product->id,
					'language_slug' => $language->slug,
					'name' 			=> $faker->sentence,
					'slug' 			=> $faker->unique->slug,
					'description' 	=> $faker->realText(200),
					'created_at' 	=> $faker->dateTimeBetween('-4 months', '-3 month'),
					'updated_at' 	=> $faker->dateTimeBetween('-2 months', '-1 month'),
				]);
            }
        }
    }
}