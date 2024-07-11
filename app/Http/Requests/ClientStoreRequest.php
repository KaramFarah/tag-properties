<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'name'                    => 'required',
            'email'                   => ['required' , Rule::unique('contacts')->ignore(request()->contact->id ?? '')],
            'mobile'                  => ['required' ,'digits:10' , Rule::unique('contacts')->ignore(request()->contact->id ?? '')],
            'whatsapp'                => ['nullable' ,'digits:10' , Rule::unique('contacts')->ignore(request()->contact->id ?? '')],
            'campaign_id'             => 'required',
            'lead_quality'            => 'required',
            'landline'                => 'nullable|numeric',                
            'is_lead'                 => 'required',
            'agent_id'                => 'nullable',
            'country'                 => 'nullable',
            'interests'               => 'nullable',
            'preferred_languages'     => 'nullable',
            'priority'                => 'nullable',
            'birthday'                => 'nullable',                
            'title'                   => 'nullable',                
            'address'                 => 'nullable',                
            'occupation'              => 'nullable',                
            'company'                 => 'nullable',                
            'passport'                => 'nullable',                
            'passport_expiry'         => 'nullable',                
            'passport_photocopy'      => 'nullable',                
            'financing'               => 'nullable',                
            'rooms'                   => 'nullable',                
            'budget'                  => 'nullable',                
            'expected_purchase_time'  => 'nullable'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'This Feild is Required!',
            'email.required' => 'This Feild is Required!',
            'email.required' => 'This Feild is Required!',
            'campaign_id.required' => 'This Feild is Required!',
            'is_lead.required' => 'This Feild is Required!',
            'mobile.required' => 'This Feild is Required!',
            'lead_quality' => 'This Feild is Required!',
            'mobile.unique' => 'This Number is Already Taken!',
            'email.unique' => 'This Email is Already Taken!',
            'whatsapp.digits' => 'Make Sure This Feild Contain Only 10 Numbers!',
            'landline.numeric' => 'Make Sure This Feild Contain Only Numbers!!'
        ];
    }
}
