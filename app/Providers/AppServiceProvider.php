<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\EloquentUserRepository;
use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Infrastructure\Persistence\EloquentCategoryRepository;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Persistence\EloquentProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Definir el namespace por defecto para los modelos
        $this->app->alias('Illuminate\Database\Eloquent\Model', 'Model');
        $this->app->bind('model', function () {
            return new \App\Domain\Entities;
        });
    }
}
