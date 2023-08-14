<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' =>'required',
            'email' =>'email',
            // 'website' =>'url',
            'logo'=>'nullable|dimensions:min_width=100,min_height=100'
        ];
    }
    public function messages(): array
{
    return [
        'name.required' => 'Company Name is required',
        'email.email' => 'Email is Invalid',
        // 'website.url' => 'Invalid Url',
        'logo.dimensions' => 'The minimum dimenshion of the logo must be 100 x 100',
    ];
}
}
