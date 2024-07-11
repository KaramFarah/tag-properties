<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\File;

class CareerCvRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'email',
                'required',
            ],
            'cv' => [
                File::types(['png', 'gif', 'jpeg', 'jpg', 'pdf', 'doc', 'docx']),
                'nullable',
            ],
        ];
    }
}
