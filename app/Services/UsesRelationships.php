<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

trait UsesRelationShips {
    /**
	 * The query with relationships.
	 * 
     * @var Builder
     */
    protected $query;
	
    /**
     * Eager load relationships.
     *
     * @param array $relations
     * @return void
     */
    protected function bootRelationships(): void {
        if ($this->withRelationships) {
            $this->query = $this->model->with($this->withRelationships);
        }
    }
}