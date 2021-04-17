<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRelationRequest extends FormRequest
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
           //
        ];
    }

    public function queries() {
        return [
            'sort' => $this->sort ? $this->sort : 'id',
            'offset' => $this->offset ? intval($this->offset) : 0,
            'limit' => $this->limit ? intval($this->limit) : null,
        ];
    }
}
