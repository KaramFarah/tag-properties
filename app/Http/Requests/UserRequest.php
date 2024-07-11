<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return request()->route('user') ? Gate::allows('user_edit') : Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email' . (request()->route('user') ? ',' . request()->route('user')->id : ''),
            ],
            'birthdate' => [
                'nullable',
                'date_format:' . config('panel.date_format'),
            ],
            'password' => [
                'nullable',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
        ];
    }
}
