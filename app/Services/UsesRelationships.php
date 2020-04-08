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
     * @return BaseServiceInterface
     */
    public function with(array $relations): BaseServiceInterface {
        $this->query = $this->model->with($relations);
		
        return $this;
    }
}