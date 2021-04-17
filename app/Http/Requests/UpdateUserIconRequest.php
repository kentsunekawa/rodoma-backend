<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserIconRequest extends FormRequest
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
            // 'fileNmae' => 'required|string',
            // 'image' => 'required|string',
        ];
    }

    public function messages() {
        return [
            // 'fileName.required' => 'file name is required',
            // 'fileName.string' => 'file name must be string',
            // 'image.required' => 'image is required',
            // 'image.string' => 'image must be string',
        ];
    }

    public function failedValidation(Validator $validator) {
        $response = [
            'errors' => $validator->errors()->toArray(),
        ];
        throw new HttpResponseException(response()->json($response, 422));
    }
}
