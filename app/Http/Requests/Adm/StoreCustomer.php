<?php

namespace App\Http\Requests\Adm;

use Illuminate\Foundation\Http\FormRequest;
use Rule;


class StoreCustomer extends FormRequest
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
     * @param bool $web
     * @return array
     */
    public function rules($web = false)
    {
        $rules = [
            'full_name' => 'required'
            ,'cpf' => 'sometimes|nullable|formato_cpf'
            ,'cnpj' => 'sometimes|nullable|formato_cnpj'
            ,'phone' => 'sometimes|nullable|celular_com_ddd'
            ,'email' => 'required|unique:users'
            ,'password' => 'required|confirmed|min:6'
        ];

        return $rules;
    }
}
