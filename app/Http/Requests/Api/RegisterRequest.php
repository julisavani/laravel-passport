<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string:255',
            'last_name' => 'required|string:255',
            'dob' => 'required|date',
            'profile_image' => 'nullable|image',
            'email' => 'required|email|unique:users|string:255',
            'password' => ['required', 'confirmed', Password::min(8)
                ->mixedCase()
                ->uncompromised()
                ->numbers()
                ->symbols()],
        ];
    }
}
