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
                File::types(['png', 'gif', 'jpeg', 'jpg', 'pdf', 'ppt', 'pptx', 'xls', 'xlsx', 'doc', 'docs'])
            ],
            'projectPhotos' => [
                'array',
                'nullable',
            ],
            'projectPhotos.*' => [
                File::types(['png', 'gif', 'jpeg', 'jpg', 'pdf', 'ppt', 'pptx', 'xls', 'xlsx', 'doc', 'docs'])
            ],
            'availabilityList' => [
                'nullable',
            ],
            'availabilityList.*' => [
                File::types(['pdf', 'xls', 'xlsx', 'doc', 'docs'])
            ],
            'paymentPlan' => [
                'nullable',
            ],
            'paymentPlan.*' => [
                File::types(['pdf', 'xls', 'xlsx', 'doc', 'docs'])
            ],
            'brochure' => [
                'nullable',
            ],
            'brochure.*' => [
                File::types(['pdf', 'xls', 'xlsx', 'doc', 'docs'])
            ],
        ];
    }
    public function messages()
    {
        return [
            'availabilityList.*' => 'Only PDF Allowed',
            'paymentPlan.*' => 'Only PDF Allowed',
            'brochure.*' => 'Only PDF Allowed',
        ];
    }
}