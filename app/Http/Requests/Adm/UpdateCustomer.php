<?php

namespace App\Http\Requests\Adm;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomer extends FormRequest
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
            'id' => 'exists:customers'
            ,'full_name' => 'required'
            ,'cpf' => 'formato_cpf'
            ,'cnpj' => 'formato_cnpj'
            ,'phone' => 'celular_com_ddd'
        ];
    }
}
