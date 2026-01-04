<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'bail|required|unique:packages,name,' . $this->id,
            'alumni_limit_type' => 'bail|required|integer',
            'alumni_limit' => 'bail|required_if:alumni_limit_type,1|integer',
            'event_limit_type' => 'bail|required|integer',
            'event_limit' => 'bail|required_if:event_limit_type,1|integer',
            'custom_domain' => 'bail|nullable',
            'monthly_price' => 'bail|required|numeric',
            'yearly_price' => 'bail|required|numeric',
            'icon' => 'bail|'.($this->id ? 'nullable' : 'required').'|mimes:png,jpg,jpeg'
        ];

        return $rules;
    }
}
