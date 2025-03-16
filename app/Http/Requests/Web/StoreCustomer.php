<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

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
            'full_name' => 'required',
            'birthday_date' => 'required|date_format:d/m/Y|before_or_equal:-18 years',
            'terms' => 'required',
            'email' => 'required|unique:customers,email|email',
            'cpf' => 'sometimes|nullable|formato_cpf',
            'profile_image' => 'sometimes|image|mimes:png,jpg,jpeg',
            // 'cnpj' => 'sometimes|nullable|formato_cnpj',
            // 'phone' => 'sometimes|nullable|celular_com_ddd',
            'password' => 'required|confirmed|min:6'
        ];

        return $rules;
    }
}
