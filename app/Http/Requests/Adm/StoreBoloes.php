<?php

namespace App\Http\Requests\Adm;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoloes extends FormRequest
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
            'concurso_id' => 'required'
            ,'name' => 'required'
            ,'cotas' => 'required|min:1'
            ,'cotas_available' => 'required|min:1'
        ];
    }
}
