<?php

namespace App\Http\Requests\annonce;

use App\Models\Annonce;
use App\Models\ContactType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAnnonceRequest extends FormRequest
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
            'use_client_contacts' => ['boolean'],
            'contacts' => ['array'],
            'contacts.*.contactTypeId' => ['required', Rule::exists(ContactType::class, 'id')],
            'contacts.*.value' => ['string', 'max:255', 'nullable'],
            'images' => [
                'nullable',
                'array',
                function ($attribute, $value, $fail) {
                    $annonce = Annonce::findOrFail($this->route('annonce'));

                    $existingImagesCount = $annonce->images()->count();

                    if ($existingImagesCount + count($value ?? []) > 6) {
                        $fail('The total number of images for this annonce cannot exceed 6.');
                    }
                },
            ],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ];
    }
}
