<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseServiceInterface {
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
	 * 
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id): ?Model;
	
    /**
     * Create a new instance.
     *  
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;
	
    /**
	 * Update an existing instance.
	 *  
     * @param int $id
     * @param array $attributes
     * @return Model
	 * 
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(int $id, array $attributes): Model;
	
    /**
     * Delete an instance.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
	
    /**
     * Return the count of all instances.
     *
     * @return int
     */
    public function count(): int;
}