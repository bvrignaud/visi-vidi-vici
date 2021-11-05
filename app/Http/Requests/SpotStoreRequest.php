<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpotStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:255',
            'lng' => 'required|numeric|between:-180,180',
            'lat' => 'required|numeric|between:-180,180',
        ];
    }
}
