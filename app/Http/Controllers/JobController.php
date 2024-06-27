<?php

namespace App\Http\Controllers;

use App\Services\CombinedJobService;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Http\Requests\SearchJobRequest;
use App\Http\Resources\JobResource;
use App\Services\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $combinedJobService;
    protected $jobService;

    public function __construct(CombinedJobService $combinedJobService, JobService $jobService)
    {
        $this->combinedJobService = $combinedJobService;
        $this->jobService = $jobService;
    }

    public function search(SearchJobRequest $request)
    {
        $filters = $request->validated(); 
        $jobs = $this->combinedJobService->getCombinedJobs($filters);

        if ($jobs->isEmpty()) {
            return JobResource::collection($jobs)->additional(['message' => 'No jobs found.']);
        }

        return JobResource::collection($jobs);
    }

    public function store(StoreJobRequest $request)
    {
        $job = $this->jobService->createJob($request->all());

        return new JobResource($job);
    }

    public function show($id)
    {
        $job = $this->jobService->getJobById($id);
        return new JobResource($job);
    }

    public function update(UpdateJobRequest $request, $id)
    {
        $job = $this->jobService->updateJob($id, $request->all());
        return new JobResource($job);
    }
}
