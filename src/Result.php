<?php

namespace stekel\LaravelBench;

class Result {
    
    /**
     * Raw output
     *
     * @var string
     */
    protected $rawOutput;
    
    /**
     * Values
     *
     * @var array
     */
    protected $values;
    
    /**
     * Construct
     *
     * @param string $output
     */
    public function __construct($output) {
    
        $this->rawOutput = $output;
        
        foreach(explode("\n", $output, 100) as $line) {
            
            if (starts_with($line, 'Time taken for tests:')) {
                $this->values['totalTime'] = floatval(trim(str_after($line, ':')));
            }
            
            if (starts_with($line, 'Failed requests:')) {
                $this->values['failedRequests'] = intval(trim(str_after($line, ':')));
            }
            
            if (starts_with($line, 'Total transferred:')) {
                $this->values['totalTransferred'] = intval(trim(str_after($line, ':')));
            }
            
            if (starts_with($line, 'Requests per second:')) {
                $this->values['requestsPerSecond'] = floatval(trim(str_after($line, ':')));
            }
        }
    }
    
    /**
     * Return the raw output
     *
     * @return string
     */
    public function rawOutput() {
    
        return $this->rawOutput;
    }
    
    public function __get($field) {
    
        if (isset($this->values[$field])) {
            
            return $this->values[$field];
        }
        
        return null;
    }
}