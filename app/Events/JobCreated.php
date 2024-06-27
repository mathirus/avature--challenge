<?php

namespace App\Events;

use App\Models\Job;
use Illuminate\Queue\SerializesModels;

class JobCreated
{
    use SerializesModels;

    public $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }
}
