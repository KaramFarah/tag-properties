<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

use Illuminate\Validation\Rules\File;

class UnitRequest extends FormRequest
{
    public function authorize()
    {
        return request()->route('unit') ? Gate::allows('unit_edit') : Gate::allows('unit_create');
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
            'location' => [
                'string',
                'nullable',
            ],
            'price' => [
                'integer',
                'required',
            ],
            'property_type' => [
                'integer',
                'required',
            ],
            'property_status' => [
                'integer',
                'required',
            ],
            'area_sqft' => [
                'integer',
                'nullable',
            ],
            'bedrooms' => [
                'string',
                'nullable',
            ],
            'bedrooms' => [
                'string',
                'nullable',
            ],
            'bathrooms' => [
                'string',
                'nullable',
            ],
            'property_id' => [
                'string',
                'nullable',
            ],
            'land_size' => [
                'integer',
                'nullable',
            ],
            'garage' => [
                'boolean',
                'nullable',
            ],
            'garage_size' => [
                'integer',
                'nullable',
            ],
            'age_year' => [
                'integer',
                'nullable',
            ],
            'yt_video_url' => [
                'string',
                'nullable',
            ],
            'availability' => [
                'integer',
                'nullable',
            ],
            'featuered' => [
                'integer',
                'nullable',
            ],
            'published' => [
                'integer',
                'nullable',
            ],
            'photos' => 'nullable|array|',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'attachment-file' => 'nullable|array|',
            'attachment-file.*' => 'mimes:pdf|max:5048',
            'floorPlan-file' => 'nullable|array|',
            'floorPlan-file.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',

        ];
    }
    public function messages()
        {
            return [
                'places.*.*.max'  => 'Too Larg Input!',
                'inputs.*.*.max'  => 'Too Larg Input!',
                'photos.*.mimes' => 'Wrong File Type!',
                'photos.*.max' => 'Too Larg File!',
                'attachment-file.*.mimes' => 'Only pdf Allowed',
                'attachment-file.*.max' => 'Too Larg File!',
                'floorPlan-file.*.mimes' => 'Wrong File Type!',
                'floorPlan-file.*.max' => 'Too Larg File!',
            ];
        }
}
