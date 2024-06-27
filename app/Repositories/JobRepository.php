<?php

namespace App\Repositories;

use App\Models\Job;

class JobRepository
{
    public function getFilteredJobs(array $filters = [])
    {
        $filters = $this->normalizeFilters($filters);

        $query = Job::query();
        $this->applyFilters($query, $filters);

        return $query->with(['category', 'jobType', 'country'])->get();
    }

    public function create(array $data)
    {
        $data['skills'] = array_map('strtolower', $data['skills']);
        return Job::create($data);
    }

    public function findById($id)
    {
        return Job::with(['category', 'jobType', 'country'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        if (isset($data['skills'])) {
            $data['skills'] = array_map('strtolower', $data['skills']);
        }
        $job = Job::findOrFail($id);
        $job->update($data);
        return $job;
    }

    private function applyFilters($query, array $filters)
    {
        if (!empty($filters['skills'])) {
            $query->where(function($query) use ($filters) {
                foreach ($filters['skills'] as $skill) {
                    $query->orWhereJsonContains('skills', strtolower($skill));
                }
            });
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['job_type_id'])) {
            $query->where('job_type_id', $filters['job_type_id']);
        }

        if (!empty($filters['country_id'])) {
            $query->where('country_id', $filters['country_id']);
        }

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['salary_min'])) {
            $query->where('salary', '>=', $filters['salary_min']);
        }

        if (!empty($filters['salary_max'])) {
            $query->where('salary', '<=', $filters['salary_max']);
        }
    }

    private function normalizeFilters(array $filters)
    {
        if (!empty($filters['skills'])) {
            $filters['skills'] = array_map('strtolower', $filters['skills']);
        }

        return $filters;
    }
}
