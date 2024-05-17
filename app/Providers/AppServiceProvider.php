<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
