<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LeadStoreRequest extends FormRequest
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
            // dd(request()->lead->id);
            // 'phone'=> [ 'required',
            //             'digits:10',
            //             Rule::unique('employees')->ignore(request()->route('employee')->id ?? '')],
            return [
                'country'              => 'nullable',
                'interests'            => 'nullable',
                'priority'             => 'nullable',
                'preferred_languages'  => 'nullable',
                'agent_id'             => 'nullable',                
                'lead_quality'         => 'required',
                'is_lead'              => 'required',
                'name'                 => 'required',
                'email'                => ['required' , Rule::unique('contacts')->ignore(request()->lead->id ?? '')],
                'mobile'               => ['required' ,'digits:10' , Rule::unique('contacts')->ignore(request()->lead->id ?? '')],
                'campaign_id'          => 'required',
            ];
        }
        public function messages()
        {
            return [
                'name.required'        => 'This Feild is Required!',
                'email.required'       => 'This Feild is Required!',
                'email.required'       => 'This Feild is Required!',
                'campaign_id.required' => 'This Feild is Required!',
                'is_lead.required'     => 'This Feild is Required!',
                'mobile.required'      => 'This Feild is Required!',
                'lead_quality'         => 'This Feild is Required!',
                'mobile.unique'        => 'This Number is Already Taken!',
                'mobile.email'         => 'This Number is Already Taken!',
            ];
        }
    }

