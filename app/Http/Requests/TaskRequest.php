<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9-]+$/',
            'priority' => 'required|regex:/^[0-9]+$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required',
            'name.regex' => 'The name Should contain only (Letters, Numbers, hyphens)',
            'priority.required' => 'The priority field is required',
            'priority.regex' => 'The name Should contain only Numbers',
        ];
    }
}
