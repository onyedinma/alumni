<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
        return [
            'name' => ['required', 'max:120'],
            'email' => ['required', 'email', 'unique:users'],
            'mobile' => ['required'],
            'address' => ['required'],
            'role' => ['required'],
            'password' => ['required'],
        ];
    }
}
