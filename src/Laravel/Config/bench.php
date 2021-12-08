<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel-Bench Configuration
    |--------------------------------------------------------------------------
    |
    | The following are configuration options for the stekel:bench command.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Custom Assessments Array
    |--------------------------------------------------------------------------
    |
    | List all classes that should be loaded into the stekel:bench command.
    |
    | Example: Tests\Performance\LargeQuery::class
    |
    */

    'custom_assessments' => [
        \stekel\LaravelBench\Assessments\Homepage::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Valid Environments
    |--------------------------------------------------------------------------
    |
    | List the environments the performance routes should be accessible on.
    */

    'valid_environments' => [
        'local'
    ],
];
