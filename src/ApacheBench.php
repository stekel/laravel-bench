<?php

namespace stekel\LaravelBench;

class ApacheBench {
    
    /**
     * Executable
     *
     * @var string
     */
    const EXECUTABLE = 'ab';
    
    /**
     * Options added to the executable call
     *
     * @var string
     */
    protected $options = '';
    
    /**
     * Url to hit
     *
     * @var string
     */
    protected $url = 'http://localhost/';
    
    /**
     * Don't show the percentage table
     *
     * @return $this
     */
    public function noPercentageTable() {
    
        $this->options .= '-d ';
        
        return $this;
    }
    
    /**
     * Ignore inconsistant length errors
     *
     * @return $this
     */
    public function ignoreLengthErrors() {
    
        $this->options .= '-l ';
        
        return $this;
    }
    
    /**
     * Don't show the progress output
     *
     * @return $this
     */
    public function noProgressOutput() {
    
        $this->options .= '-q ';
        
        return $this;
    }
    
    /**
     * Set the number of concurrent requests
     *
     * @param  integer $concurrency
     * @return $this
     */
    public function concurrency($concurrency=1) {
    
        $this->options .= '-c '.$concurrency.' ';
        
        return $this;
    }
    
    /**
     * Set the number of total requests
     *
     * @param  integer $requests
     * @return $this
     */
    public function requests($requests=1) {
    
        $this->options .= '-n '.$requests.' ';
        
        return $this;
    }
    
    /**
     * Set the url
     *
     * @param  string $url
     * @return $this
     */
    public function url($url) {
        
        $numSlashes = substr_count($url, '/');
        
        if ($numSlashes == 2) {
            
            $url = str_finish($url, '/');
        }
        
        $this->url = $url;
        
        return $this;
    }
    
    /**
     * Output the full command structure
     *
     * @return string
     */
    public function fullCommand() {
    
        return str_finish(self::EXECUTABLE.' '.$this->options, ' ').$this->url;
    }
    
    /**
     * Execute the given command
     *
     * @return Result
     */
    public function execute() {
    
        return (new Result(shell_exec($this->fullCommand())));
    }
}