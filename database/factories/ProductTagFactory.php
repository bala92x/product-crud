<?php

use Faker\Generator as Faker;

$factory->define('App\Models\ProductTag', function (Faker $faker) {
    return [
		'created_at' => $faker->dateTimeBetween('-4 months', '-3 month'),
		'updated_at' => $faker->dateTimeBetween('-2 months', '-1 month'),
    ];
});
