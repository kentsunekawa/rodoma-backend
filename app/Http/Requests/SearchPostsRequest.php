<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchPostsRequest extends FormRequest
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
            'status' => $this->status,
            'keyword' => $this->keyword ? $this->keyword : '',
            'category_id' => $this->category ? intval($this->category) : 0,
            'specialty_id' => $this->specialty ? intval($this->specialty) : 0,
            'sort' => $this->sort ? $this->sort : 'id',
            'offset' => $this->offset ? intval($this->offset) : 0,
            'limit' => $this->limit ? intval($this->limit) : null,
        ];
    }
}
