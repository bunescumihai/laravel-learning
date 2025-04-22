<?php

namespace App\Http\Requests\annonce;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnonceTerrainRequest extends UpdateAnnonceRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'specifications.surface' => ['required', 'numeric', 'min:1', 'max:10000'],
        ]);
    }
}
