<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCar extends FormRequest
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
            'name' => 'required|string|max:255', // Car name is required, must be a string, and max 255 characters
            'model' => 'required|string|max:255', // Car model is required, must be a string, and max 255 characters
            'price' => 'required|numeric|min:0', // Price is required, must be numeric, and minimum 0
            'is_available' => 'required|boolean', // Availability status is required and must be a boolean
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The car name is required.',
            'model.required' => 'The car model is required.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be at least 0.',
            'is_available.required' => 'The availability status is required.',
            'is_available.boolean' => 'The availability status must be true or false.',
        ];
    }
}
