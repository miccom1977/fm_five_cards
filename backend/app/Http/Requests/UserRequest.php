<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'sometimes|string|email|unique:users',
            'password' => 'sometimes|string|min:8',
            'name' => 'sometimes|string|min:3|max:15',
            'role' => 'sometimes|string|min:4|max:6',
        ];
    }
}
