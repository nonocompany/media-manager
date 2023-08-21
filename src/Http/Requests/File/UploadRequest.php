<?php

namespace Nonocompany\MediaManager\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,xls,xlsx,ppt,pptx']
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return __('MediaManager::general.validation');
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
