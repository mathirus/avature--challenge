<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'skills' => 'sometimes|required|array',
            'skills.*' => 'string|max:255',
            'company_name' => 'sometimes|required|string|max:255',
            'salary' => 'nullable|numeric',
            'experience_level' => 'nullable|string|max:255',
            'country_id' => 'sometimes|required|exists:countries,id',
            'category_id' => 'sometimes|required|exists:categories,id',
            'job_type_id' => 'sometimes|required|exists:job_types,id',
            'is_enabled' => 'boolean',
        ];
    }
}
