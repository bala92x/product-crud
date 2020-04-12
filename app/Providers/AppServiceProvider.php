<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

use App\Services\Interfaces\BaseServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\FileServiceInterface;
use App\Services\BaseService;
use App\Services\ProductService;
use App\Services\FileService;
use App\Services\Cache\BaseCache;
use App\Services\Cache\ProductCache;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        if (Config::get('cache.on')) {
            $this->app->bind(BaseServiceInterface::class, 
				BaseCache::class);
            $this->app->when(BaseCache::class)
					->needs(BaseServiceInterface::class)
					->give(BaseService::class);
				
            $this->app->bind(ProductServiceInterface::class, 
				ProductCache::class);
            $this->app->when(ProductCache::class)
					->needs(ProductServiceInterface::class)
					->give(ProductService::class);
        } else {
            $this->app->bind(BaseServiceInterface::class, BaseService::class);
            $this->app->bind(ProductServiceInterface::class, ProductService::class);
        }

        $this->app->bind(FileServiceInterface::class, FileService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}
