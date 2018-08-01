<?php

namespace stekel\LaravelBench;

use Illuminate\Support\ServiceProvider;
use stekel\LaravelBench\Assessment;
use stekel\LaravelBench\Laravel\Console\LaravelBench as LaravelBenchCommand;

class LaravelBenchServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    
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
        $this->app->singleton('assessment', function($app) {
            return new Assessment([
                Assessments\Homepage::class,
            ]);
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Assessment::class,
            'assessment'
        ];
    }
}
