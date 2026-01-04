<?php

namespace App\Http\Requests\Admin;

use App\Rules\UniqueWithConditions;
use Illuminate\Foundation\Http\FormRequest;

class PassingYearRequest extends FormRequest
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

        return [
            'passing_year' => [
                'bail',
                'required',
                new UniqueWithConditions('passing_years', 'name', $this->id, 'id', ['tenant_id' => getTenantId()])
            ]
        ];
    }
}
