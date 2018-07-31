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

## Usage

Run the following command from the root of a Laravel application

```bash
php artisan stekel:bench {test}
```

The following tests are available:

- homepage - Sends 100 requests to `/`