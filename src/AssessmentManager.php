<?php

namespace stekel\LaravelBench;

class AssessmentManager {
    
    /**
     * Assesments
     *
     * @var Collection
     */
    protected $assessments;
    
    /**
     * Construct
     *
     * @param array $assessments
     */
    public function __construct(array $assessments) {
        
        $this->assessments = collect($assessments)->transform(function($assessment) {
            
            if (class_exists($assessment)) {
                
                return new $assessment();
            }
            
            return null;
        })->filter();
    }
    
    /**
     * Find an assessment by it's slug
     *
     * @param  string $slug
     * @return AssessmentContract
     */
    public function findBySlug($slug) {
        
        return $this->assessments->first(function($assessment) use($slug) {
            return $assessment->slug == $slug;
        });
    }
    
    /**
     * Return all the assessments
     *
     * @return Collection
     */
    public function all() {
    
        return $this->assessments;
    }
}