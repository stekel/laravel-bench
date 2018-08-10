<?php

namespace stekel\LaravelBench\Tests\Unit;

use stekel\LaravelBench\ApacheBench;
use stekel\LaravelBench\Tests\TestCase;

class ApacheBenchTest extends TestCase {

    /** @test **/
    public function can_output_the_ab_command_without_flags() {
        
        $ab = new ApacheBench();
        
        $this->assertEquals('ab http://localhost/', $ab->fullCommand());
    }
    
    /** @test **/
    public function can_output_the_ab_command_with_flags() {
        
        $ab = new ApacheBench();
        
        $ab->noPercentageTable()
            ->ignoreLengthErrors()
            ->noProgressOutput()
            ->concurrency(10)
            ->requests(100)
            ->url('http://test.local/');
        
        $this->assertEquals('ab -d -l -q -c 10 -n 100 http://test.local/', $ab->fullCommand());
    }
    
    /** @test **/
    public function can_fix_a_url_without_a_trailing_slash_when_creating_a_command() {
        
        $ab = new ApacheBench();
        
        $ab->url('http://test.local');
        
        $this->assertEquals('ab http://test.local/', $ab->fullCommand());
    }
}