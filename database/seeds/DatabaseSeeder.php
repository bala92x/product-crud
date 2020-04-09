<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void {
        $this->call([
			LanguagesTableSeeder::class,
			ProductsTableSeeder::class,
			ProductTranslationsTableSeeder::class,
			ProductTagsTableSeeder::class,
			ProductTagTranslationsTableSeeder::class,
			ProductsProductTagsTableSeeder::class
		]);
    }
}
