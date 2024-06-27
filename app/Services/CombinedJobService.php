<?php

namespace App\Services;

use App\Models\Job;
use Illuminate\Support\Collection;

class CombinedJobService
{
    protected $jobService;
    protected $externalJobService;

    public function __construct(JobService $jobService, ExternalJobService $externalJobService)
    {
        $this->jobService = $jobService;
        $this->externalJobService = $externalJobService;
    }

    public function getCombinedJobs(array $filters = [])
    {
        $filters = $this->normalizeFilters($filters);

        $internalJobs = $this->jobService->searchJobs($filters)->toArray();
        $externalJobs = $this->externalJobService->fetchExternalJobs($filters)->toArray();
        $combinedJobsArray = array_merge($internalJobs, $externalJobs);

        return collect($combinedJobsArray)->map(function ($job) {
            return new Job($job);
        });
    }

    private function normalizeFilters(array $filters)
    {
        if (!empty($filters['skills'])) {
            $filters['skills'] = array_map('strtolower', $filters['skills']);
        }

        return $filters;
    }
}
