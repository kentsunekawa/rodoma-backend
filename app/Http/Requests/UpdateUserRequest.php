<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|string|email|max:225',
            'icon_url' => 'string',
            'profile.id' => 'required|numeric',
            'profile.user_id' => 'required|numeric',
            'profile.category_id' => 'required|numeric',
            'profile.specialty_id' => 'required|numeric',
            'profile.catch_copy' => 'string',
            'profile.description' => 'string',
            'profile.sns.*.profile_id' => 'required|numeric',
            'profile.sns.*.sns_id' => 'required|numeric',
            'profile.sns.*.url' => 'required|string',
        ];
    }

    public function messages() {
        return [
            'id.required' => 'id_required',
            'id.numeric' => 'id_numeric',
            'name.required' => 'name_required',
            'name.string' => 'name_string',
            'email.required' => 'email_required',
            'email.email' => 'email_required',
            'email.string' => 'email_string',
            'email.max:225' => 'email_longer',
            'icon_url' => 'icon_url_string',
            'profile.id.required' => 'profile_id_required',
            'profile.id.numeric' => 'profile_id_numeric',
            'profile.category_id.required' => 'category_id_required',
            'profile.category_id.numeric' => 'category_id_numeric',
            'profile.specialty_id.required' => 'specialty_id_required',
            'profile.specialty_id.numeric' => 'specialty_id_numeric',
            'profile.catch_copy.string' => 'catch_copy_string',
            'profile.description.string' => 'description_string',
            'profile.sns.*.profile_id.required' => 'profile_id_required',
            'profile.sns.*.profile_id.numeric' => 'profile_id_numeric',
            'profile.sns.*.sns_id.required' => 'sns_id_required',
            'profile.sns.*.sns_id.numeric' => 'sns_id_numeric',
            'profile.sns.*.url.required' => 'url_required',
            'profile.sns.*.url.string' => 'url_string',
        ];
    }

    public function failedValidation(Validator $validator) {
        $response = [
            'status' => 'error_validation',
            'data' => [
                'errors' => $validator->errors()->toArray(),
            ]
        ];
        throw new HttpResponseException(response()->json($response, 422));
    }
}
