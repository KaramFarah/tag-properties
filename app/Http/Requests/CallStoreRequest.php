<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallStoreRequest extends FormRequest
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
            'date'       => 'required',
            'type'       => 'required',
            'topic'      => 'nullable',
            'status'     => 'required',
            'summary'    => 'nullable',
            'agent_id'   => 'required',
            'contact_id' => 'required',
        ];
        
    }

    public function messages()
    {
        return [
             'date.required'       => 'You must Choose The Date!',
             'type.required'       => 'Type can\'t be Empty!',
             'topic.required'      => 'Topic can\'t be Empty!',
             'status.required'     => 'Status can\'t be Empty!',
             'summary.required'    => 'Summary can\'t be Empty!',
             'agent_id.required'   => 'You must Choose Agent!',
             'contact_id.required' => 'You must Choose Contact!',
        ];
    }
}
