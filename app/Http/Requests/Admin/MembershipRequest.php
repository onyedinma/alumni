<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MembershipRequest extends FormRequest
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
            'title' => 'required','string', 'min:3', 'max:92'.$this->slug,
            'price' => 'required|numeric|min:0',
            'duration_type' => 'required',
            'duration' => 'required|numeric',
            'status' => 'required'
        ];
        if(isset($this['slug'])){
            $rules['badge'] = 'bail|nullable|mimes:jpg,jpeg,png';
        }
        else{
            $rules['badge'] = 'bail|required|mimes:jpg,jpeg,png';
        }
        return $rules;
    }
}
