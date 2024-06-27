<?php

namespace App\Listeners;

use App\Events\JobCreated;
use App\Mail\JobAlertMail;
use App\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendJobAlert implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(JobCreated $event)
    {

        $job = $event->job;
        $subscriptions = $this->getSubscriptionsMatchingJob($job);

        if ($subscriptions->isEmpty()) {
            Log::info('No matching subscriptions found for job: ' . $job->id);
            return;
        }

        $this->sendJobAlerts($job, $subscriptions);
    }

    private function getSubscriptionsMatchingJob($job)
    {
        return Subscription::where(function ($query) use ($job) {
            $this->applyCountryFilter($query, $job->country_id);
            $this->applySkillsFilter($query, $job->skills);
            $this->applyNameFilter($query, $job->name);
            $this->applySalaryFilter($query, $job->salary);
        })->get();
    }

    private function applyCountryFilter($query, $countryId)
    {
        if (!empty($countryId)) {
            $query->whereJsonContains('filters->country_id', $countryId);
        }
    }

    private function applySkillsFilter($query, $skills)
    {
        if (!empty($skills)) {
            $query->where(function ($query) use ($skills) {
                foreach ($skills as $skill) {
                    $query->orWhereJsonContains('filters->skills', strtolower($skill));
                }
            });
        }
    }

    private function applyNameFilter($query, $name)
    {
        if (!empty($name)) {
            $query->orWhere(function ($query) use ($name) {
                $keywords = explode(' ', $name);
                foreach ($keywords as $keyword) {
                    $query->orWhere('filters->name', 'like', '%' . $keyword . '%');
                }
            });
        }
    }

    private function applySalaryFilter($query, $salary)
    {
        if (!empty($salary)) {
            $query->where(function ($query) use ($salary) {
                $query->where(function ($query) use ($salary) {
                    $query->whereNull('filters->salary_min')->orWhere('filters->salary_min', '<=', $salary);
                });
                $query->where(function ($query) use ($salary) {
                    $query->whereNull('filters->salary_max')->orWhere('filters->salary_max', '>=', $salary);
                });
            });
        }
    }

    private function sendJobAlerts($job, $subscriptions)
    {
        foreach ($subscriptions as $subscription) {
            Log::info('Sending email to: ' . $subscription->email);

            Mail::to($subscription->email)->send(new JobAlertMail($job));
        }
    }
}
