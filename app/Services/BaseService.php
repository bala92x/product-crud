<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

use App\Services\Interfaces\BaseServiceInterface;

class BaseService implements BaseServiceInterface {
    /**
     * @var Model
     */
    protected $model;
	
    /**
     * @var Builder
     */
    protected $query;
	
    /**
     * BaseService constructor.
     *
     * @param Model $model
	 * @return void
     */
    public function __construct(Model $model) {
        $this->model = $model;
    }
	
    /**
	 * Get all instances.
	 * 
	 * @return Collection
     */
    public function all(): Collection {
        $queryBase = $this->query ?: $this->model;
		
        return $queryBase->get();
    }

    /**
	 * Find an instance by id.
	 * 
     * @param int $id
     * @return Model
     */
    public function find(int $id): ?Model {
        $queryBase = $this->query ?: $this->model;
		
        return $queryBase->findOrFail($id);
    }
	
    /**
     * Create a new instance.
     *  
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model {
        return $this->model->create($attributes);
    }
	
    /**
	 * Update an existing instance.
	 *  
     * @param int $id
     * @param array $attributes
     * @return Model
     */
    public function update(int $id, array $attributes): Model {
        return tap($this->model->findOrFail($id))->update($attributes);
    }

    /**
     * Delete an instance.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $instance = $this->model->find($id);
		
        if ($instance) {
            return $instance->delete();
        }

        return false;
    }

    /**
     * Return the count of all instances.
     *
     * @return int
     */
    public function count(): int {
        return $this->model->count();
    }
	
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