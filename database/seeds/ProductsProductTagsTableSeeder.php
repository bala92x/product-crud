<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use App\Models\Product;
use App\Models\ProductTag;

class ProductsProductTagsTableSeeder extends Seeder {
    /**
     * Run the products_product_tag_s table seeds.
     *
     * @return void
     */
    public function run() {
        $faker 				= Faker::create();
        $products 			= Product::all();
        $productTagCount 	= ProductTag::count();
		
        foreach ($products as $product) {
            for ($i=1; $i <= 2; $i++) {
                DB::table('products_product_tags')->insert([
					'product_id' 		=> $product->id,
					'product_tag_id' 	=> min([$product->id * $i, $productTagCount]),
					'created_at' 		=> $faker->dateTimeBetween('-4 months', '-3 month'),
					'updated_at' 		=> $faker->dateTimeBetween('-2 months', '-1 month')
				]);
            }
        }
    }
}