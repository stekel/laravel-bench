<?php

namespace stekel\LaravelBench;

class Assessment {
    
    /**
     * Assesments
     *
     * @var Collection
     */
    protected $assessments;
    
    public function __construct(array $assessments) {
    
        $this->assessments = collect($assessments)->transform(function($assessment) {
            return new $assessment();
        });
    }
    
    public function findBySlug($slug) {
    
        return $this->assessments->first(function($assessment) use($slug) {
            return $assessment->slug == $slug;
        });
    }
}