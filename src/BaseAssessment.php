<?php

namespace stekel\LaravelBench;

abstract class Assessment implements AssessmentContract {
    
    public function execute() {
    
        return $this->viaApacheBench();
    }
    
    private function viaApacheBench() {
        
        return (new ApacheBench())
            ->noPercentageTable()
            ->noProgressOutput()
            ->concurrency($this->concurrency)
            ->requests($this->requests)
            ->url(url($this->path))
            ->execute();
    }
}