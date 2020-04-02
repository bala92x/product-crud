<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use App\Models\ProductTag;
use App\Models\Language;

class ProductTagTranslationsTableSeeder extends Seeder {
    /**
     * Run the product_tag_translations table seeds.
     *
     * @return void
     */
    public function run() {
        $faker 			= Faker::create();
        $productTags 	= ProductTag::all();
        $languages 		= Language::all();
		
        foreach ($productTags as $productTag) {
            foreach ($languages as $language) {
                $name = $faker->unique->word;

                DB::table('product_tag_translations')->insert([
					'product_tag_id' 	=> $productTag->id,
					'language_id' 		=> $language->id,
					'name' 				=> $name,
					'slug' 				=> $name,
					'created_at' 		=> $faker->dateTimeBetween('-4 months', '-3 month'),
					'updated_at' 		=> $faker->dateTimeBetween('-2 months', '-1 month'),
				]);
            }
        }
    }
}