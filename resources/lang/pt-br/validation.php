<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | O campo following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    '(and :count more error)' => '(e mais :count erro)',
    '(and :count more errors)' => '(e mais :count erros)',
    'accepted' => 'O campo :attribute precisa ser aceito.',
    'active_url' => 'O campo :attribute não é uma URL válida.',
    'after' => 'O campo :attribute precisa ser uma data pós :date.',
    'after_or_equal' => 'O campo :attribute necessita que a data seja maior ou igual a :date.',
    'alpha' => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash' => 'O campo :attribute deve conter apenas letras, números, traços e sublinhados.',
    'alpha_num' => 'O campo :attribute deve conter apenas letras e números.',
    'array' => 'O campo :attribute deve ser um array.',
    'before' => 'O campo :attribute deve ser uma data pré :date.',
    'before_or_equal' => 'Você precisa ser maior de 18 anos para prosseguir',
    'between' => [
        'numeric' => 'O campo :attribute deve ter um valor entre :min e :max.',
        'file' => 'O campo :attribute deve ter um tamanho entre :min e :max kilobytes.',
        'string' => 'O campo :attribute deve ter uma quantidade de caracteres entre :min e :max .',
        'array' => 'O campo :attribute deve conter uma quantidade de itens entre :min e :max .',
    ],
    'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'O campo :attribute não possui o mesmo valor do campo de confirmação',
    'date' => 'O campo :attribute não é uma data válida.',
    'date_equals' => 'O campo :attribute deve conter uma data igual a :date.',
    'date_format' => 'O campo :attribute deve ser do formato :format.',
    'different' => 'O campo :attribute e :other precisam ser diferentes.',
    'digits' => 'O campo :attribute deve conter :digits digitos.',
    'digits_between' => 'O campo :attribute deve conter dígitos entre :min e :max .',
    'dimensions' => 'O campo :attribute possui dimensões de imagem inválidas.',
    'distinct' => 'O campo :attribute tem valores duplicados.',
    'email' => 'O campo :attribute deve ser um email válido.',
    'ends_with' => 'O campo :attribute deve terminar como um dos seguintes valores: :values',
    'exists' => 'O campo selecionado :attribute é inválido.',
    'file' => 'O campo :attribute deve ser um arquivo.',
    'filled' => 'O campo :attribute deve conter um valor.',
    'gt' => [
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'file' => 'O campo :attribute deve ser maior que :value kilobytes.',
        'string' => 'O campo :attribute deve ter mais que :value caracteres.',
        'array' => 'O campo :attribute deve conter mais que :value itens.',
    ],
    'gte' => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'file' => 'O campo :attribute deve ser maior ou igual a :value kilobytes.',
        'string' => 'O campo :attribute deve ter mais ou igual a :value caracteres.',
        'array' => 'O campo :attribute deve ter :value ou mais itens',
    ],
    'image' => 'O campo :attribute deve ser uma imagem.',
    'in' => 'O campo selecionado :attribute é inválido.',
    'in_array' => 'O campo :attribute não existe em :other.',
    'integer' => 'O campo :attribute deve ser um número.',
    'ip' => 'O campo :attribute deve ser um endereço de IP válido.',
    'ipv4' => 'O campo :attribute deve ser um endereço IPv4 válido.',
    'ipv6' => 'O campo :attribute deve ser um endereço IPv6 válido.',
    'json' => 'O campo :attribute deve ser um endereço JSON válido..',
    'lt' => [
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'file' => 'O campo :attribute deve ser menor que :value kilobytes.',
        'string' => 'O campo :attribute deve conter menos que :value caracteres.',
        'array' => 'O campo :attribute deve conter menos que :value itens.',
    ],
    'lte' => [
        'numeric' => 'O campo :attribute deve conter menos ou igual a :value.',
        'file' => 'O campo :attribute deve conter menos ou igual a :value kilobytes.',
        'string' => 'O campo :attribute deve conter menos ou igual a :value caracteres.',
        'array' => 'O campo :attribute não deve conter mais que :value itens.',
    ],
    'max' => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file' => 'O campo :attribute não pode ser maior que :max kilobytes.',
        'string' => 'O campo :attribute não pode ser maior que :max caracteres.',
        'array' => 'O campo :attribute não pode ter mais que :max itens.',
    ],
    'mimes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
        'file' => 'O campo :attribute deve ter no mínimo :min kilobytes.',
        'string' => 'O campo :attribute deve ter no mínimo :min caracteres.',
        'array' => 'O campo :attribute deve ter no mínimo :min itens.',
    ],
    'not_in' => 'O campo selecionado :attribute é inválido.',
    'not_regex' => 'O campo :attribute format é inválido.',
    'numeric' => 'O campo :attribute deve ser um número.',
    'present' => 'O campo :attribute deve estar presente.',
    'regex' => 'O campo :attribute tem o formato inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless' => 'O campo :attribute é obrigatório a não ser que :other seja ou tenha :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values é presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não é presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presentes.',
    'same' => 'O campo :attribute e :other precisam ser iguais.',
    'size' => [
        'numeric' => 'O campo :attribute deve ser :size.',
        'file' => 'O campo :attribute deve ser :size kilobytes.',
        'string' => 'O campo :attribute deve ser :size caracteres.',
        'array' => 'O campo :attribute deve conter :size itens.',
    ],
    'starts_with' => 'O campo :attribute deve iniciar com os seguintes valores: :values',
    'string' => 'O campo :attribute deve ser uma string.',
    'timezone' => 'O campo :attribute deve ser uma timezone válida.',
    'unique' => 'O campo :attribute já esta registrado.',
    'uploaded' => 'O campo :attribute falhou ao ser enviado.',
    'url' => 'O campo :attribute formato é inválido.',
    'uuid' => 'O campo :attribute deve ser uma UUID válida.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'phone_rule' => 'O telefone/celular digitado possui um formato inválido'
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
