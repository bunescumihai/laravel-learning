<?php

namespace App\Http\Requests\annonce;

use App\Models\ContactType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAnnonceRequest extends FormRequest
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
            'title' => ['required', 'max:256'],
            'description' => ['required', 'max:2048'],
            'address' => ['required', 'max:256'],
            'start_publication_date' => ['required', 'date'],
            'end_publication_date' => ['required', 'date', 'after:start_publication_date'],
            'contacts' => ['array'],
            'contacts.*.contactTypeId' => ['required', Rule::exists(ContactType::class, 'id')],
            'contacts.*.value' => ['string', 'max:255', 'nullable'],
            'images' => ['required','array', 'min:1', 'max:6'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ];
    }
}
