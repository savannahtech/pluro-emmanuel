<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AnalyzeHtmlRequest extends FormRequest
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
            'file' => 'required|file|mimes:html|max:1024', // Max 1MB
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'The HTML file is required.',
            'file.file' => 'Please upload a valid file.',
            'file.mimes' => 'Only HTML files are allowed.',
            'file.max' => 'The file size must not exceed 1MB.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        // Flatten validation errors to a simple array of strings
        $errors = collect($validator->errors()->all())->unique()->toArray();

        throw new HttpResponseException(
            response()->json([
                'errors' => $errors,
            ], 422)
        );
    }
}
