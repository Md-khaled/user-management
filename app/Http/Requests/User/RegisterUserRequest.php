<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
            'file' => 'required|max:2048',
            // 'addresses.*.street' => 'required|string|max:255',
            // 'addresses.*.city' => 'required|string|max:255',
            // 'addresses.*.state' => 'required|string|max:255',
            // 'addresses.*.postal_code' => 'required|string|max:255',
            // 'addresses.*.country' => 'required|string|max:255',
        ];
    }
}
