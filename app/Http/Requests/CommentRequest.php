<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize()
    {
        return request()->route('comment') ? Gate::allows('comment_edit') : Gate::allows('comment_create');
    }

    public function rules()
    {
        return [
            'author' => [
                'integer',
                'required',
            ],
            'contact_id' => [
                'integer',
                'required',
            ],
            'contact_id' => [
                'string',
                'required',
            ],

            'publish_date' => [
                'required',
            ],
        ];
    }
}
