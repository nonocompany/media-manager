<?php

namespace Nonocompany\MediaManager\Http\Requests\Folder;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return __('MediaManager::folder.attributes');
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
