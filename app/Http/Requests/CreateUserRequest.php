<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required',  'unique:users', 'email'],
            'password' => ['required', 'min:6'],
            'address' => ['required', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'role' => ['required', 'in:admin,client'],
        ];
    }


}
