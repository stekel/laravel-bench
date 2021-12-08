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
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../Config/bench.php' => config_path('bench.php'),
        ]);

        if (app()->environment(config('bench.valid_environments'))) {
            $this->app['router']->get('performance/{slug}', function ($slug) {
                $assessment = app('assessment')->findBySlug($slug);

                if (is_null($assessment)) {
                    abort(404);
                }

                return $assessment->route();
            });
        }

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
            __DIR__.'/../Config/bench.php',
            'bench'
        );

        $this->app->singleton('assessment', function () {
            return new AssessmentManager(config('bench.custom_assessments'));
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
