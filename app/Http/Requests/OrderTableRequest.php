<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderTableRequest extends FormRequest
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
            'user_name' => 'required',
            'sum' => 'required',
            'itemOrders' => 'required',
            'delivery' => 'required'
        ];
    }
}
