<?php

namespace stekel\LaravelBench;

use Illuminate\Support\ServiceProvider;
use stekel\LaravelBench\Laravel\Console\LaravelBench as LaravelBenchCommand;

class LaravelBenchServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            
            $this->commands([
                LaravelBenchCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
