<?php

declare(strict_types=1);

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
            'optimal_wind_direction' => 'required|integer|between:0,360',
            'timezone' => 'required|timezone',
        ];
    }
}
