<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relación con el modelo Job
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
