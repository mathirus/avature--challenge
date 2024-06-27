<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'skills' => 'required|array',
            'skills.*' => 'string|max:255',
            'company_name' => 'required|string|max:255',
            'salary' => 'required|nullable|numeric',
            'experience_level' => 'nullable|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'category_id' => 'required|exists:categories,id',
            'job_type_id' => 'required|exists:job_types,id',
            'is_enabled' => 'boolean',
        ];
    }
}
