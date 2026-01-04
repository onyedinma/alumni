<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HowItsWorkRequest extends FormRequest
{

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
            "name" => ['required'],
            "title" => ['required', Rule::unique('how_its_works')->ignore($this->id)->whereNull('deleted_at')],
            'description' => ['required'],
        ];

        if($this->id){
            $rules['image'] = 'nullable|mimes:jpg,jpeg,png';
        }
        else{
            $rules['image'] = 'required|mimes:jpg,jpeg,png';
        }

        return $rules;
    }
}
