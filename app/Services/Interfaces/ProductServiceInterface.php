<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ProductServiceInterface {
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
     * Delete the product files folder.
     *
     * @return bool
     */
    public function deleteAllFiles(): bool;
}