<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ResetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages() {
        return [
            'token.required' => 'token_required',
            'email.required' => 'email_required',
            'email.email' => 'email_required',
            'email.unique' => 'email_used',
            'passoword.required' => 'password_required',
            'password.string' => 'password must be number',
            'password.min:8' => 'password_shorter',
            'password.confirmed' => 'password_not_match',
        ];
    }

    public function failedValidation(Validator $validator) {

        $response = [
            'status' => 'error_validation',
            'data' => [
                'errors' => $validator->errors()->toArray(),
            ],
        ];
        throw new HttpResponseException(new JsonResponse($response, 400));
    }
}
