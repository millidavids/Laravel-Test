<?php

namespace millidavids\SimpleGui;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class SimpleGuiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'SimpleGui');
        $this->setupRoutes($this->app->router);
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/SimpleGui'),
        ], 'public');
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/SimpleGui'),
        ]);
    }

    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'millidavids\SimpleGui\Http\Controllers'],
            function ($router) {
                require __DIR__ . '/Http/routes.php';
            });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}