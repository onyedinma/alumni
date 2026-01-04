<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PhotoGalleryRequest extends FormRequest
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
            'caption' => 'required|min:1|max:195',
        ];

        if($this->id){
            $rules['photo'] = 'bail|nullable|mimes:jpg,jpeg,png';
        }
        else{
            $rules['photo'] = 'bail|required|mimes:jpg,jpeg,png';
        }

        return $rules;
    }
}
