<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCommentRequest extends FormRequest
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
            'user_id' => 'required',
            'post_id' => 'required',
            'comment' => 'required|max:1000',
        ];
    }

    public function messages() {
        return [
            'user_id.required' => 'user_id_required',
            'post_id.required' => 'post_id_required',
            'comment.required' => 'comment_required',
            'comment.max:1000' => 'comment_over',
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

    public function validationData() {
        return array_merge($this->request->all(), [
            'post_id' => $this->postId,
        ]);
    }
}
