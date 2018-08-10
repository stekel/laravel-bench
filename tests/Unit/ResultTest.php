<?php

namespace Tests\Unit;

use stekel\LaravelBench\Result;
use stekel\LaravelBench\Tests\TestCase;

class ResultTest extends TestCase {

    /** @test **/
    public function can_return_the_raw_output_given() {
        
        $result = new Result($this->sampleOutput());
        
        $this->assertEquals($this->sampleOutput(), $result->rawOutput());
    }
    
    /** @test **/
    public function can_return_the_values_from_the_output_of_an_apache_bench_run() {
        
        $result = new Result($this->sampleOutput());
        
        $this->assertEquals('0.154', $result->totalTime);
        $this->assertEquals('0', $result->failedRequests);
        $this->assertEquals('6399', $result->totalTransferred);
        $this->assertEquals('6.50', $result->requestsPerSecond);
        $this->assertNull($result->notAValidParameter);
    }
    
    /**
     * Return sample output from an Apache-Bench command
     *
     * @return string
     */
    private function sampleOutput() {
        
        return 'This is ApacheBench, Version 2.3 <$Revision: 1706008 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking localhost.local (be patient).....done


Server Software:        Apache/2.4.18
Server Hostname:        localhost.local
Server Port:            443
SSL/TLS Protocol:       TLSv1.2,ECDHE-RSA-AES256-GCM-SHA384,2048,256

Document Path:          /
Document Length:        4716 bytes

Concurrency Level:      1
Time taken for tests:   0.154 seconds
Complete requests:      1
Failed requests:        0
Total transferred:      6399 bytes
HTML transferred:       4716 bytes
Requests per second:    6.50 [#/sec] (mean)
Time per request:       153.937 [ms] (mean)
Time per request:       153.937 [ms] (mean, across all concurrent requests)
Transfer rate:          40.59 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        5    5   0.0      5       5
Processing:   149  149   0.0    149     149
Waiting:      149  149   0.0    149     149
Total:        154  154   0.0    154     154';
    }
}