<?php

namespace BeeDelivery\ifood;

use Illuminate\Support\ServiceProvider;

class IfoodServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ifood.php' => config_path('ifood.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ifood.php', 'ifood');


        // Register the service the package provides.
        $this->app->singleton('ifood', function ($app) {
            return new Ifood;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ifood'];
    }
}