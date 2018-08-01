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
        
        $result = $assessment->execute();
        
        $this->table([
            'Metric',
            'Value'
        ], [
            ['Total Time', $result->totalTime.' sec'],
            ['Failed Requests', $result->failedRequests],
            ['Total Transfered', $result->totalTransferred.' bytes'],
            ['Requests Per Second', $result->requestsPerSecond],
        ]);
    }
}
