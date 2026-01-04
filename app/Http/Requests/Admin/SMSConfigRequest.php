<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SMSConfigRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'TWILIO_ACCOUNT_SID' => 'required',
            'TWILIO_AUTH_TOKEN' => 'required',
            'TWILIO_PHONE_NUMBER' => 'required'
        ];


        return $rules;
    }
}
