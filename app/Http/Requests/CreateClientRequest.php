<?php

namespace App\Http\Requests;

use App\Enums\ContactTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole(['admin', 'manager']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'contacts' => ['array'],
            'contacts.*.type' => ['required', 'string', 'in:' . implode(',', array_map(fn($case) => $case->value, ContactTypeEnum::cases()))],
            'contacts.*.value' => ['string', 'max:255', 'nullable'],
        ];
    }
}
