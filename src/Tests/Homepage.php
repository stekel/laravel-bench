<?php

namespace stekel\LaravelBench\Tests;

use stekel\LaravelBench\ApacheBench;

class Homepage {
    
    public $path = '/';
    
    public $concurrency = 10;
    
    public $requests = 100;
    
    public function handle() {
    
        return (new ApacheBench())
            ->noPercentageTable()
            ->noProgressOutput()
            ->concurrency($this->concurrency)
            ->requests($this->requests)
            ->url(url($this->path))
            ->execute();
    }
}