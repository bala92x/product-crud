<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

trait UsesPagination {
    /**
    * Get all instances.
    * 
    * @return Collection
    */
    abstract public function all(): Collection;
	
    /**
     * Return the count of all instances.
     *
     * @return int
     */
    abstract public function count(): int;
	
    /**
     * Get a page of several instances with pagination meta data.
     * 
     * @param mixed $page
     * @param mixed $limit
     * @return LengthAwarePaginator
     */
    public function paginated($page = 1, $limit = null): LengthAwarePaginator {
        $count		= $this->count();
        $page 		= max((int)$page, 1);
        $limit		= (int)$limit ?: $count;
        $all 		= $this->all();
        $paginator 	= new LengthAwarePaginator(
			$all->forPage($page, $limit),
			$count,
			$limit,
			$page,
			['path' => request()->url()]
		);

        return $paginator;
    }
}