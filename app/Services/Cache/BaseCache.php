<?php

namespace App\Services\Cache;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Services\BaseService;
use App\Services\Interfaces\BaseServiceInterface;

class BaseCache implements BaseServiceInterface {
    use GeneratesCacheKey;

    /**
     * Cache lifetime in seconds.
     * 
     * @var int
     */
    protected $lifetime;
	
    /**
	 * The service used to manage models.
	 * 
     * @var BaseService
     */
    protected $baseService;
	
    /**
	 * The model managed by this service.
	 * 
     * @var Model
     */
    protected $model;

    /**
     * BaseCache constructor.
     * 
	 * @param Model $model
	 * @param BaseServiceInterface $service
     * @return void
     */
    public function __construct(Model $model, BaseServiceInterface $service) {
        $this->model		= $model;
        $this->service 		= $service;
        $this->lifetime 	= Config::get('config.lifetime');
    }
	
    /**
	 * Get all instances.
	 * 
	 * @return Collection
     */
    public function all(): Collection {
        return Cache::remember(
			$this->generateCacheKey(['all']),
			$this->lifetime,
			function () {
			    return $this->service->all();
			}
		);
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
        return $this->service->paginated($page, $limit, $this->all());
    }

    /**
	 * Find an instance by id.
	 * 
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model {
        return Cache::remember(
			$this->generateCacheKey([$id]),
			$this->lifetime,
			function () use ($id) {
			    return $this->service->find($id);
			}
		);
    }
	
    /**
     * Create a new instance.
     *  
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model {
        $instance = $this->service->create($attributes);
		
        $this->forgetMultipleKeys(['all'], ['count']);
		
        Cache::put($this->generateCacheKey([$instance->id]), $instance, $this->lifetime);
		
        return $instance;
    }
	
    /**
	 * Update an existing instance.
	 *  
     * @param int $id
     * @param array $attributes
     * @return Model
     */
    public function update(int $id, array $attributes): Model {
        $this->forgetMultipleKeys(['all'], [$id]);
		
        $instance = $this->service->update($id, $attributes);
		
        Cache::put($this->generateCacheKey([$id]), $instance, $this->lifetime);

        return $instance;
    }

    /**
     * Delete an instance.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $this->forgetMultipleKeys(['all'], ['count'], [$id]);
		
        return $this->service->delete($id);
    }

    /**
     * Return the count of all instances.
     *
     * @return int
     */
    public function count(): int {
        return Cache::remember(
			$this->generateCacheKey(['count']),
			$this->lifetime,
			function () {
			    return $this->service->count();
			}
		);
    }
	
    /**
     * Forget multiple cache keys.
     * 
	 * @param array ...$toForget
     * @return void
     */
    private function forgetMultipleKeys(array ...$toForget): void {
        foreach ($toForget as $fragments) {
            Cache::forget($this->generateCacheKey($fragments));
        }
    }
}