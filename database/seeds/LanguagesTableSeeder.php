<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Faker\Factory as Faker;

class LanguagesTableSeeder extends Seeder {
    /**
     * Run the languages table seeds.
     *
     * @return void
     */
    public function run() {
        $faker 		= Faker::create();
        $languages	= Config::get('app.languages');
		
        foreach ($languages as $language) {
            DB::table('languages')->insert([
				'name' 			=> $language['name'],
				'code' 			=> $language['code'],
				'slug' 			=> $language['slug'],
				'created_at' 	=> $faker->dateTimeBetween('-4 months', '-3 month'),
				'updated_at' 	=> $faker->dateTimeBetween('-2 months', '-1 month'),
			]);
        }
    }
}