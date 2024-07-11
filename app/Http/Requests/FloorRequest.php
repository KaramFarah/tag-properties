<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FloorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'space'         => 'nullable|max:255',                
            'master_bed'    => 'nullable|max:255',                
            'kitchen'       => 'nullable|max:255',                
            'dining'        => 'nullable|max:255',                
            'baths'         => 'nullable|max:255',                
            'storage'       => 'nullable|max:255',                
            'description'   => 'nullable',                
            'floor_photos'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
