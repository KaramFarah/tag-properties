<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;

class InstallmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return request()->route('installment') ? Gate::allows('installment_edit') : Gate::allows('installment_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => [
                'string',
                'required'
            ],
            'milestone' => [
                'string',
                'required'
            ],
            'payment' => [
                'string',
                'required'
            ]
        ];
    }
}
