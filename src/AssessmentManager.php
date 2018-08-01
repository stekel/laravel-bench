<?php

namespace stekel\LaravelBench;

class AssessmentManager {
    
    /**
     * Assesments
     *
     * @var Collection
     */
    protected $assessments;
    
    public function __construct(array $assessments) {
        
        $this->assessments = collect($assessments)->transform(function($assessment) {
            
            if (class_exists($assessment)) {
                
                return new $assessment();
            }
            
            return null;
        })->filter();
    }
    
    public function findBySlug($slug) {
        
        return $this->assessments->first(function($assessment) use($slug) {
            return $assessment->slug == $slug;
        });
    }
}