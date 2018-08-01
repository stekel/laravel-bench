<?php

namespace stekel\LaravelBench\Assessments;

use stekel\LaravelBench\ApacheBench;

class Homepage {
    
    public $path = '/';
    
    public $concurrency = 10;
    
    public $requests = 100;
    
    public $slug = 'homepage';
    
    public function execute() {
    
        return (new ApacheBench())
            ->noPercentageTable()
            ->noProgressOutput()
            ->concurrency($this->concurrency)
            ->requests($this->requests)
            ->url(url($this->path))
            ->execute();
    }
}