<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'filters' => 'nullable|array',
            'filters.name' => 'nullable|string|max:255',
            'filters.country_id' => 'nullable|exists:countries,id',
            'filters.skills' => 'nullable|array',
            'filters.skills.*' => 'string|max:255',
            'filters.salary_min' => 'nullable|numeric|min:0',
            'filters.salary_max' => 'nullable|numeric|min:0',
        ];
    }
}
