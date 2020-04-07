<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Interfaces\BaseServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\BaseService;
use App\Services\ProductService;
use App\Services\ImageService;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(BaseServiceInterface::class, BaseService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ImageServiceInterface::class, ImageService::class);
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
