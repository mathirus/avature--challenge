<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'skills' => $this->skills,
            'company_name' => $this->company_name,
            'salary' => $this->salary,
            'experience_level' => $this->experience_level,
            'country' => $this->country,
            'job_type' => $this->jobType,
            'category' => $this->category,
        ];
    }
}
