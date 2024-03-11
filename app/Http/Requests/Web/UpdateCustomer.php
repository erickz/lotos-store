<?php

namespace App\Http\Requests\Web;

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
            'full_name' => 'required',
            'birthday_date' => 'required|date|before_or_equal:' . now()->subYears(18)->toDateString(),
            'email' => 'required|unique:customers,email,' . $this->user()->id,
            'cpf' => 'sometimes|nullable|formato_cpf',
            'cnpj' => 'sometimes|nullable|formato_cnpj',
            'phone' => 'sometimes|nullable|celular_com_ddd',
            'password' => 'sometimes|nullable|confirmed|min:6'
        ];
    }
}
