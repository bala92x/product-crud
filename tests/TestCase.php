<?php

namespace Tests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {
    use CreatesApplication;
	
    /**
     * Set up testing environment.
     *
     * @return void
     */
    public function setUp(): void {
        parent::setUp();

        $this->withHeaders([
			'Accept' => 'application/json'
		]);
    }
	
    /**
     * Sanitize data to allow assertions.
     *
     * @param array $data
     * @return void
     */
    protected function sanitizeData(array $data): array {
        $keysNotNeeded = [
			'id',
			'created_at',
			'updated_at',
			'deleted_at',
			'image',
			'image_path',
			'product_id',
			'product_tag_id',
			'product_tag_ids',
			'product_tags',
			'product_translations',
			'pivot'
		];

        $sanitizedData = [];
		
        foreach ($data as $key => $value) {
            $snakeKey = Str::snake($key);

            if (!in_array($snakeKey, $keysNotNeeded)) {
                $sanitizedData[$snakeKey] = $value;
            }
        }
		
        return $sanitizedData;
    }
}
