<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductsTableSeeder extends Seeder {
    /**
     * Run the products table seeds.
     *
     * @return void
     */
    public function run() {
        $faker 			= Faker::create();
        $seederQuantity = (int)Config::get('app.seeder_quantity');
		
        for ($i = 0; $i < $seederQuantity; $i++) {
            $imageFolder 	= '/products/' . uniqid();
            $imagePath 		= Storage::disk('public')
									->putFile($imageFolder, UploadedFile::fake()->image('image.jpeg'));

            DB::table('products')->insert([
				'published_at' 		=> $faker->dateTimeBetween('-3 months', '+1 month'),
				'published_until' 	=> $faker->dateTimeBetween('+1 month', '+3 months'),
				'price' 			=> $faker->numberBetween(1, 500) * 100,
				'image_path'		=> $imagePath,
				'created_at'		=> $faker->dateTimeBetween('-7 months', '-6 month'),
				'updated_at'		=> $faker->dateTimeBetween('-5 months', '-4 month')
			]);
        }
    }
}
