<?php

namespace App\Services;

trait UsesRelationShips {
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