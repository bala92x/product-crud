<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface BaseServiceInterface
 * 
 * @package App\Services\Interfaces
 */
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
     * @return bool
     */
    public function update(int $id, array $attributes): bool;
	
    /**
     * Deletes an instance.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id): bool;
	
    /**
     * Eager load relationships.
     *
     * @param array $relations
     * @return BaseServiceInterface
     */
    public function with(array $relations): BaseServiceInterface;
}