<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use Carbon\Carbon;

class ExternalJobService
{
    protected $countryMap;

    public function __construct()
    {
        $this->countryMap = DB::table('countries')->pluck('id', 'name')->toArray();
        $this->externalJobServiceUrl = config('services.external_job_service.url');

    }

    public function fetchExternalJobs(array $filters = [])
    {
        $queryParams = http_build_query($filters);
        $response = Http::get("{$this->externalJobServiceUrl}?{$queryParams}");

        if ($response->failed()) {
            return collect();
        }

        $externalJobs = $response->json();
        return $this->filterExternalJobs($this->formatExternalJobs($externalJobs), $filters);
    }

    private function formatExternalJobs($externalJobs)
    {
        $formattedJobs = collect();
        $now = Carbon::now();

        foreach ($externalJobs as $country => $jobs) {
            $countryId = $this->countryMap[$country] ?? null;

            foreach ($jobs as $job) {
                $formattedJobs->push(new Job([
                    'name' => $job[0],
                    'salary' => $job[1],
                    'country_id' => $countryId,
                    'skills' => $this->parseSkills($job[2]),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]));
            }
        }

        return $formattedJobs;
    }

    private function parseSkills($skillsXml)
    {
        $xml = simplexml_load_string($skillsXml);
        $skills = [];

        foreach ($xml->skill as $skill) {
            $skills[] = strtolower((string) $skill);
        }

        return $skills;
    }

    private function filterExternalJobs($jobs, array $filters)
    {
        $filters = $this->normalizeFilters($filters);

        return $jobs->filter(function ($job) use ($filters) {

            if (!empty($filters['skills'])) {
                if (empty(array_intersect($filters['skills'], $job->skills))) {
                    return false;
                }
            }

            return true;
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
