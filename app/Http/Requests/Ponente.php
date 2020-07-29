<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Ponente extends FormRequest
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
            'ponente'   => 'required|regex:/^[\pL\s\-]+$/u|max:120',
            'email'     => 'required|email|max:100|unique:ponentes,email,'.$this->id,
            'user_id'   => 'required',
        ];
    }
}
