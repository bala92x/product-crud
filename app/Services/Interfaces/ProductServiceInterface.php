<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

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
     * Delete the product images folder.
     *
     * @return bool
     */
    public function deleteImages(): bool;
}