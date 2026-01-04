<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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

        $rules =  [
            'language' => 'bail|required|unique:languages,language,'.$this->id,
        ];

        if(is_null($this->id)){
            $rules['iso_code'] = 'bail|required|unique:languages,iso_code';
            $rules['flag'] = 'bail|required|image|mimes:jpeg,png,jpg,svg,webp';
        }
        else{
            $rules['flag'] = 'bail|nullable|image|mimes:jpeg,png,jpg,svg,webp';
        }

        $rules['font'] = 'nullable|file|mimetypes:font/ttf';

        return $rules;
    }
}
