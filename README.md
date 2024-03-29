# Laravel-Bench

Php wrapper for Apache-Bench with Laravel integration

----

## Requirements

- PHP >= 7.0
- ApacheBench `$ ab`

## Installation

### Laravel

Require it with Composer:
```bash
composer require stekel/laravel-bench --dev
```

Publish the package configuration file
```bash
artisan vendor:publish --provider=stekel\LaravelBench\Laravel\Providers\LaravelBenchServiceProvider
```

## Usage

Run the following command from the root of a Laravel application

```bash
php artisan stekel:bench {test}
```

The following tests are available:

- homepage - Sends 100 requests to `/`

## Custom Tests

Create a new test somewhere in your repository and add the c

The following test will execute 100 requests (10 at a time) against the homepage ('/') 

```php
<?php // App\Benchmarks\Homepage.php

namespace stekel\LaravelBench\Assessments;

use stekel\LaravelBench\Assessment;

class Homepage extends Assessment
{
    /**
     * Path to execute the test against
     *      - If null, create route via slug for execution
     */
    public ?string $path = '/';

    /**
     * Number of requests to send at a time
     */
    public int $concurrency = 10;

    /**
     * Number of total requests to send
     */
    public int $requests = 100;

    /**
     * Slug to use for reference
     */
    public string $slug = 'homepage';
}
```

The following test will execute 100 requests (10 at a time) against a custom route ('/performance/large-query') which is generated by the test. The given route is only active for the environments listed in the configuration file and will execute any code within the `route()` function.

```php
<?php
// App\Benchmarks\LargeQuery.php

namespace App\Benchmarks;

use stekel\LaravelBench\Assessment;

class LargeQuery extends Assessment
{
    public $path = null;
    public $concurrency = 10;
    public $requests = 100;
    public $slug = 'large-query';
    
    public function route() {
        User::limit(1000)->get();
    }
}
```
