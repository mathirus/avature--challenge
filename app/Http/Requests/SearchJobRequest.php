<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchJobRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'skills' => 'sometimes|array',
            'skills.*' => 'string',
            'category_id' => 'sometimes|exists:categories,id',
            'job_type_id' => 'sometimes|exists:job_types,id',
            'country_id' => 'sometimes|exists:countries,id',
            'name' => 'sometimes|string',
            'salary_min' => 'sometimes|numeric|min:0',
            'salary_max' => 'sometimes|numeric|min:0|gte:salary_min',
        ];
    }
}
