<?php

namespace stekel\LaravelBench\Assessments;

use stekel\LaravelBench\Assessment;

class Homepage extends Assessment {
    
    public $path = '/';
    
    public $concurrency = 10;
    
    public $requests = 100;
    
    public $slug = 'homepage';
}