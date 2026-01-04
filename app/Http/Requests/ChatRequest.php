<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
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
        $allowedExtensions = ['png', 'jpg', 'svg', 'jpeg', 'gif', 'mp4', 'mov', 'avi', 'mkv', 'webm', 'flv'];

        $rules = [
            'message' => 'bail|nullable|string',
            'file.*' => [
                'bail',
                'nullable',
                'mimes:' . implode(',', $allowedExtensions),
            ],
        ];
        
        if(($this->input('message') == NULL || $this->input('message') == '') && request()->file == NULL ){
            $rules['message'] =  'bail|required|string';
        }

        return $rules;
    }
}
