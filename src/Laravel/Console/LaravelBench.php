<?php

namespace stekel\LaravelBench\Laravel\Console;

use Illuminate\Console\Command;

class LaravelBench extends Command {
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stekel:bench
                            {test : The name of the test to run}
                            ';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Benchmark a given url using ApacheBench.';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        
        if (is_null(shell_exec('which ab'))) {
            
            throw new \Execption('Apache Bench is not installed.');
        }
        
        $assessment = app('assessment')->findBySlug($this->argument('test'));
        
        if (is_null($assessment)) {
            
            $this->info('No test with the name of "'.$this->argument('test').'"');
            return;
        }
        
        $this->info('Executing test "'.$this->argument('test').'"...');
        
        $output = $assessment->execute();
        
        $this->info($this->cleanOutput($output));
    }
    
    private function cleanOutput($output) {
        
        $cleanedOutput = '';
        
        foreach (explode("\n", $output, 100) as $index => $line) {
            
            if (starts_with($line, 'This is ApacheBench')) {
                continue;
            }
            
            if (starts_with($line, 'Copyright 1996')) {
                continue;
            }
            
            if (starts_with($line, 'Licensed to The Apache')) {
                continue;
            }
            
            if (starts_with($line, 'Benchmarking ')) {
                continue;
            }
            
            if ($line == '') {
                continue;
            }
            
            if (starts_with($line, 'Connection Times ')) {
                continue;
            }
            
            if (ends_with($line, ' max')) {
                continue;
            }
            
            if (starts_with($line, 'Connect: ')) {
                continue;
            }
            if (starts_with($line, 'Processing: ')) {
                continue;
            }
            if (starts_with($line, 'Waiting: ')) {
                continue;
            }
            if (starts_with($line, 'Total: ')) {
                continue;
            }
            
            $cleanedOutput .= $line."\n";
        }
        
        return $cleanedOutput;
    }
}
