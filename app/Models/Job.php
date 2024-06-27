<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'skills',
        'company_name',
        'salary',
        'experience_level',
        'is_enabled',
        'country_id',
        'category_id',
        'job_type_id',
    ];

    protected $casts = [
        'skills' => 'array',
    ];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }
}
