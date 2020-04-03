<?php

namespace stekel\LaravelBench\Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use stekel\LaravelBench\AssessmentManager;
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
     * Assessments
     *
     * @var array
     */
    protected $assessments = [
        Assessments\Homepage::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../Config/bench.php' => config_path('bench.php'),
        ]);

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
        $this->mergeConfigFrom(
            __DIR__.'/../Config/bench.php', 'bench'
        );

        $this->app->singleton('assessment', function($app) {

            $this->assessments = array_merge($this->assessments, config('bench.custom_assessments'));

            return new AssessmentManager($this->assessments);
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
            'assessment'
        ];
    }
}
