<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Services\Interfaces\BaseServiceInterface;

class BaseService implements BaseServiceInterface {
    use UsesRelationships;
	
    /**
     * The model managed by this service.
     * 
     * @var Model
     */
    protected $model;
	
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
     * Get a page of several instances with pagination meta data.
     * 
     * @param mixed $page
     * @param mixed $limit
	 * @param Collection $all
     * @return LengthAwarePaginator
     */
    public function paginated($page = 1, $limit = null, Collection $all = null): LengthAwarePaginator {
        $all		= $all ?: $this->all();
        $count		= $all->count();
        $page 		= max((int)$page, 1);
        $limit		= (int)$limit ?: $count;
        $paginator 	= new LengthAwarePaginator(
			$all->forPage($page, $limit),
			$count,
			$limit,
			$page,
			['path' => request()->url()]
		);

        return $paginator;
    }

    /**
	 * Find an instance by id.
	 * 
     * @param int $id
     * @return Model
	 * 
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id): Model {
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
	 * 
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
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
}