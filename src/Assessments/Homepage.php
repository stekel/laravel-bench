<?php

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
