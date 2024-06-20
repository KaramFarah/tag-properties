<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AgentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'               => 'required',
            'email'              => [
                'required' , Rule::unique('users')->ignore(request()->agent->id ?? '')
            ],
            // 'password'           => 'nullable',
            'birthday'           => 'nullable',
            // 'user_id'            => 'nullable',
            'phone'              => 'nullable',
            'emitaes_id'         => 'nullable',
            'brn'                => 'nullable',
            'languages'          => 'nullable',
            'employee_id_number' => 'nullable',
        ];
        
    }

    public function messages()
    {
        return [
            // 'user_id' => 'This Feild is Required!',
            'name.required' => 'This Feild is Required!',
            'email.required' => 'This Feild is Required!',
        ];
    }
}
