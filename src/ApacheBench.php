<?php

namespace stekel\LaravelBench;

class ApacheBench {
    
    protected $executable = 'ab';
    
    protected $options = '';
    
    public function noPercentageTable() {
    
        $this->options .= ' -d ';
        
        return $this;
    }
    
    public function ignoreLengthErrors() {
    
        $this->options .= ' -l ';
        
        return $this;
    }
    
    public function noProgressOutput() {
    
        $this->options .= ' -q ';
        
        return $this;
    }
    
    public function concurrency($concurrency=1) {
    
        $this->options .= ' -c '.$concurrency.' ';
        
        return $this;
    }
    
    public function requests($requests=1) {
    
        $this->options .= ' -n '.$requests.' ';
        
        return $this;
    }
    
    public function url($url='http://localhost/') {
        
        $numSlashes = substr_count($url, '/');
        
        if ($numSlashes == 2) {
            
            $url = str_finish($url, '/');
        }
        
        $this->url = $url;
        
        return $this;
    }
    
    public function execute() {
    
        return shell_exec($this->executable.$this->options.$this->url);
    }
}