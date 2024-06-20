<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignStoreRequest extends FormRequest
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
            'name'        => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date',
            'description' => 'nullable',
            'network'     => 'nullable',
        ];
        
    }

    public function messages()
    {
        return [
           'name.required' => 'This Field is Required!',
            'start_date.required'   => 'This Feild Is Required!',
            'start_date.date'   => 'This Feild Must Contain Date',
            'end_date.required'   => 'This Feild Is Required!',
            'end_date.date'   => 'This Feild Must Contain Date'
        ];
    }
}