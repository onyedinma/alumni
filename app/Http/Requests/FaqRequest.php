<?php

namespace App\Http\Requests;

use App\Rules\UniqueWithConditions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FaqRequest extends FormRequest
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
            'title' => [
                'bail',
                'required',
                new UniqueWithConditions('faqs', 'title', $this->id, 'id')
            ],
            'description' => ['required'],
        ];
        return $rules;
    }
}
