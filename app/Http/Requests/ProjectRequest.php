<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\File;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return request()->route('project') ? Gate::allows('project_edit') : Gate::allows('project_create');
    }

    public function rules()
    {
        // dd($this->attachments);
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'country' => [
                'string',
                'nullable',
            ],
            'community' => [
                'string',
                'nullable',
            ],
            'location' => [
                'string',
                'nullable',
            ],
            'opening_date' => [
                'string',
                'nullable',
            ],
            'type' => [
                'string',
                'nullable',
            ],
            'attachments' => [
                'array',
                'nullable',
            ],
            'attachments.*' => [
                File::types(['png', 'jpeg', 'jpg']),
                'max:3048'
            ],
            'projectPhotos' => [
                'array',
                'nullable',
            ],
            'projectPhotos.*' => [
                File::types(['png', 'jpeg', 'jpg']),
                'max:5048'
            ],
            'brochure' => [
                'nullable',
                File::types(['pdf', 'xls', 'xlsx', 'doc', 'docs']),
                'max:5048'
            ],
        ];
    }
    public function messages()
    {
        return [
            'attachments.*' => 'Only Images Allowed',
            'attachments.*.max' => 'File Larger Than 5 mb',
            'projectPhotos.*' => 'Only Images Allowed',
            'projectPhotos.*.max' => 'Files Larger Than 5 mb',
            'brochure' => 'Only PDF Allowed',
            'brochure.max' => 'File Larger Than 5 mb',
        ];
    }
}