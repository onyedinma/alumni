<?php

namespace App\Http\Requests\Admin;

use App\Rules\UniqueWithConditions;
use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
                'currency_code' => [
                    'bail',
                    'required',
                    new UniqueWithConditions('currencies', 'currency_code', $this->id, 'id', ['tenant_id' => getTenantId()])
                ],
                'symbol' => 'required',
                'currency_placement' => 'required',
            ];
    }
}
