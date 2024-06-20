<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\File;

class DeveloperRequest extends FormRequest
{
    public function authorize()
    {
        return request()->route('developer') ? Gate::allows('developer_edit') : Gate::allows('developer_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'order' => [
                'integer',
                'nullable',
            ],
            'logo' => [
                File::types(['png', 'gif', 'jpeg', 'jpg']),
                'nullable',
            ],
        ];
    }
}
