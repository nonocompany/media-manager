<?php

namespace Nonocompany\MediaManager\Http\Requests\Folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:folders'],
            'parent_id' => ['nullable', 'exists:folders'],
            'directory' => ['nullable'],
        ];
    }

    public function attributes(): array
    {
        return __('MediaManager::folder.attributes');
    }

    public function authorize(): bool
    {
        return true;
    }
}
