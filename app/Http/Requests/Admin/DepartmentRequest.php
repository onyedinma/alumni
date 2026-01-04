<?php

namespace App\Http\Requests\Admin;

use App\Rules\UniqueWithConditions;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => [
                'bail',
                'required',
                new UniqueWithConditions('departments', 'name', $this->id, 'id', ['tenant_id' => getTenantId()])
            ],
            'short_name' => [
                'bail',
                'required',
                new UniqueWithConditions('departments', 'short_name', $this->id, 'id', ['tenant_id' => getTenantId()])
            ],
        ];
    }
}
