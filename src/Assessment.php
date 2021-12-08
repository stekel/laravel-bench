<?php

namespace stekel\LaravelBench;

abstract class Assessment implements AssessmentContract
{
    public const GLOBAL_ROUTE = 'performance';

    /**
     * Path to execute the test against
     *      - If null, create route via slug for execution
     */
    public ?string $path = null;

    /**
     * Number of requests to send at a time
     */
    public int $concurrency = 1;

    /**
     * Number of total requests to send
     */
    public int $requests = 1;

    /**
     * Slug to use for reference
     */
    public string $slug = 'default';

    /**
     * Assessment result
     */
    public ?Result $result = null;

    /**
     * Custom route execution via slug
     *   Note: this is only enabled if $path is null
     *   Route: /performance/{$slug}
     */
    public function route(): void
    {
    }

    /**
     * Is the current test within the given thresholds?
     */
    public function isValidThreshold(Result $result): void
    {
    }

    /**
     * Return the assessment as an array
     */
    public function toArray(): array
    {
        return [
            'slug' => $this->slug,
            'path' => $this->getPath(),
            'concurrency' => $this->concurrency,
            'requests' => $this->requests,
        ];
    }

    /**
     * Execute the test
     */
    public function execute(): Result
    {
        if (is_null($this->path)) {
            $this->path = $this->getPath();
        }

        $this->result = $this->viaApacheBench();

        $this->isValidThreshold($this->result);

        return $this->result;
    }

    /**
     * Use ApacheBench for test execution
     */
    private function viaApacheBench(): Result
    {
        return (new ApacheBench())
            ->ignoreLengthErrors()
            ->noPercentageTable()
            ->noProgressOutput()
            ->concurrency($this->concurrency)
            ->requests($this->requests)
            ->url(url($this->path))
            ->execute();
    }

    private function getPath(): string
    {
        return $this->path ?? self::GLOBAL_ROUTE.'/'.$this->slug;
    }
}
