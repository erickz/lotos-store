<?php

namespace App\Http\Requests\Adm;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConcurso extends FormRequest
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
            'lotery_id' => 'required'
            ,'type' => 'required'
            ,'number' => 'required'
            ,'draw_day' => 'required'
            ,'value_accumulated' => 'required'
        ];
    }
}
