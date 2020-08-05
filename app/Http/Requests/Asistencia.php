<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class Asistencia extends FormRequest
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
            'event_id'      => 'required',
            'personal_id'   => [
                'required',
                Rule::unique('asistencias')->where(function ($query) {
                    return $query->where('personal_id', $this->personal_id)
                        ->where('event_id', $this->event_id);
                })->ignore($this->id)
            ],
            'constancia'    => 'unique:asistencias'
        ];
    }

    public function messages()
{
    return [
        'personal_id.unique' => 'Esta persona ya ha sido registrada a este evento',
    ];
}
}
