<?php

namespace Nonocompany\MediaManager\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class OptionsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'width' => ["nullable", "integer"],
            'height' => ["nullable", "integer"]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
