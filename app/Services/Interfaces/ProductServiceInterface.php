<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface ProductServiceInterface
 * 
 * @package App\Services\Interfaces
 */
interface ProductServiceInterface {
    /**
	 * Get all instances.
	 * 
	 * @return Collection
     */
    public function all(): Collection;

    /**
	 * Find an instance by id.
	 * 
     * @param int $id
     * @return Model
     */
    public function find(int $id): ?Model;
}