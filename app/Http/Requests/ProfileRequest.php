<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            "name" => ['required', 'string', 'max:255'],
            "mobile" => 'bail|required|min:6|unique:users,mobile,' . auth()->id(),
            "date_of_birth" => 'required|date|before:today',
            "nick_name" => 'bail|required',
            "blood_group" => 'bail|nullable',
            "about_me" => 'bail|nullable',
            "linkedin_url" => 'bail|nullable|url',
            "facebook_url" => 'bail|nullable|url',
            "twitter_url" => 'bail|nullable|url',
            "instagram_url" => 'bail|nullable|url',
            "company" => 'bail|nullable',
            "company_designation" => 'bail|nullable',
            "company_address" => 'bail|nullable',
            "city" => 'bail|required|max:195',
            "state" => 'bail|required|max:195',
            "country" => 'bail|required|max:195',
            "zip" => 'bail|required|max:195',
            "address" => 'bail|required|max:195',
            'institution.degree.*' => 'bail|required|max:195',
            'institution.passing_year.*' => 'bail|required|max:195',
            'institution.institute.*' => 'bail|required|max:195',
            'image' => 'bail|nullable|mimes:jpg,jpeg,png',
            // FGCO Specific Fields
            'state_of_origin' => 'bail|nullable|string|max:190',
            'lga_of_origin' => 'bail|nullable|string|max:190',
            'current_job' => 'bail|nullable|string|max:190',
            'expertise' => 'bail|nullable|string|max:190',
            'company_name' => 'bail|nullable|string|max:190',
            'work_address' => 'bail|nullable|string|max:500',
            'bio' => 'bail|nullable|string',
            'first_class_id' => 'bail|nullable|exists:classes,id',
            'final_class_id' => 'bail|nullable|exists:classes,id',
            'first_house_id' => 'bail|nullable|exists:houses,id',
            'final_house_id' => 'bail|nullable|exists:houses,id',
            'passing_year_id' => 'bail|nullable|exists:passing_years,id',
        ];
        return $rules;
    }

}
