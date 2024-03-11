<?php

namespace App\Http\Requests\Adm;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerBank extends FormRequest
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
            'bearer' => 'required'
            ,'agency'=> 'required|max:5'
            ,'account_number' => 'required'
            ,'bank' => 'required'
            ,'type' => 'required'
        ];
    }
}
