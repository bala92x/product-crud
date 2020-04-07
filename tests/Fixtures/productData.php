<?php

use Illuminate\Http\UploadedFile;

return [
	'productCreateData' 		=> [
		'publishedAt'			=> '2020-09-20 00:34:42',
		'publishedUntil'		=> '2020-09-30 00:34:42',
		'price'					=> '15000',
		'image'					=> UploadedFile::fake()->image('image.jpg'),
		'productTranslations'	=>  [
			0 => [
				'languageSlug' 	=> 'hu',
				'name' 			=> 'Termék',
				'slug' 			=> 'termek',
				'description' 	=> '<b>Teszt</b> termék HTML.'
			],
			1 => [
				'languageSlug' 	=> 'en',
				'name' 			=> 'Product',
				'slug' 			=> 'product',
				'description' 	=> '<b>Test</b> product HTML.'
			]
		],
		'productTagIds'			=> [
			0 => '1',
			1 => '2',
			2 => '3'
		]
	],
	'productUpdateData'			=> [
		'publishedAt'			=> '2021-09-20 00:34:42',
		'publishedUntil'		=> '2021-09-30 00:34:42',
		'price'					=> '20000',
		'image'					=> UploadedFile::fake()->image('new-image.jpg'),
		'productTranslations'	=>  [
			1 => [
				'languageSlug' 	=> 'en',
				'name' 			=> 'New product',
				'slug' 			=> 'new-product',
				'description' 	=> '<b>New</b> product HTML.'
			]
		],
		'productTagIds'			=> [
			0 => '3',
			1 => '5',
			2 => '6'
		]
	],
	'productInvalidData'	=> [
		'publishedAt'			=> '2021-09-20 00:34:42',
		'publishedUntil'		=> '2021-08-30 00:34:42',
		'price'					=> 'not a number',
		'image'					=> null,
		'productTranslations'	=>  [
			1 => [
				'languageSlug' 	=> 'en',
				'name' 			=> 'New product',
				'slug' 			=> '\App\Models\ProductTranslation'::first()->slug,
				'description' 	=> '<b>New</b> product HTML.'
			]
		],
		'productTagIds'			=> [
			0 => 'not an id',
		]
	]
];