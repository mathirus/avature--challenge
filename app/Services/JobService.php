<?php

namespace App\Services;

use App\Events\JobCreated;
use App\Repositories\JobRepository;
use Illuminate\Support\Facades\Log;

class JobService
{
    protected $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function searchJobs(array $filters = [])
    {
        return $this->jobRepository->getFilteredJobs($filters);
    }

    public function createJob(array $data)
    {
        $job = $this->jobRepository->create($data);

        try {
            event(new JobCreated($job));
        } catch (\Exception $e) {
            Log::error('Error triggering JobCreated event: ' . $e->getMessage());
        }

        return $job;
    }

    public function getJobById($id)
    {
        return $this->jobRepository->findById($id);
    }

    public function updateJob($id, array $data)
    {
        return $this->jobRepository->update($id, $data);
    }
}
