<?php

namespace App\Http\Requests;

use App\Models\Dashboard\Tag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class TagRequest extends FormRequest
{
    public function authorize()
    {
        return request()->route('tag') ? Gate::allows('tag_edit') : Gate::allows('tag_create');
        // return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'type' => [
                'string',
                'nullable',
            ],
            'parent_id' => [
                'integer',
                'nullable',
            ],
        ];
    }
}
