<?php

use Faker\Generator as Faker;

$factory->define('App\Models\Product', function (Faker $faker) {
    return [
		'published_at' 		=> $faker->dateTimeBetween('-3 months', '+1 month'),
		'published_until' 	=> $faker->dateTimeBetween('+1 month', '+3 months'),
		'price' 			=> $faker->numberBetween(1, 500) * 100,
		'image_path' 		=> '/assets/images/product' . $faker->numberBetween(1, 100) . '.jpg',
		'created_at'		=> $faker->dateTimeBetween('-7 months', '-6 month'),
		'updated_at'		=> $faker->dateTimeBetween('-5 months', '-4 month'),
    ];
});
