<?php

namespace Totaa\TotaaPoster;

use Illuminate\Support\ServiceProvider;

class TotaaPosterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'totaa-poster');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'totaa-poster');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('totaa-poster.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/totaa-poster'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/totaa-poster'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/totaa-poster'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);

            /*
            |--------------------------------------------------------------------------
            | Seed Service Provider need on boot() method
            |--------------------------------------------------------------------------
            */
            $this->app->register(SeedServiceProvider::class);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'totaa-poster');

        // Register the main class to use with the facade
        $this->app->singleton('totaa-poster', function () {
            return new TotaaPoster;
        });
    }
}
