<?php

namespace Tests;

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
}
