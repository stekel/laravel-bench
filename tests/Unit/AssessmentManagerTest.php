<?php

namespace stekel\LaravelBench\Tests\Unit;

use stekel\LaravelBench\AssessmentManager;
use stekel\LaravelBench\Assessments\Homepage;
use stekel\LaravelBench\Tests\TestCase;

class AssessmentManagerTest extends TestCase {

    /** @test **/
    public function can_return_all_assessments_configured() {
        
        $manager = new AssessmentManager([
            Homepage::class,
        ]);
        
        $this->assertCount(1, $manager->all());
        $this->assertInstanceOf(Homepage::class, $manager->all()->first());
    }
    
    /** @test **/
    public function can_ignore_missing_injected_classes_when_getting_all_assessments_configured() {
        
        $manager = new AssessmentManager([
            Homepage::class,
            'Some\Class\That\Doesnt\Exist',
        ]);
        
        $this->assertCount(1, $manager->all());
        $this->assertInstanceOf(Homepage::class, $manager->all()->first());
    }
    
    /** @test **/
    public function can_find_a_given_class_by_its_slug() {
        
        $manager = new AssessmentManager([
            Homepage::class,
        ]);
        
        $this->assertInstanceOf(Homepage::class, $manager->findBySlug('homepage'));
    }
    
    /** @test **/
    public function can_return_null_if_a_slug_is_not_found() {
        
        $manager = new AssessmentManager([
            Homepage::class,
        ]);
        
        $this->assertNull($manager->findBySlug('slug_doesnt_exist'));
    }
}