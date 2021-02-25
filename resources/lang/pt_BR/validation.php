<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute deve ser aceito.',
    'active_url' => ':attribute não é um URL válida.',
    'after' => ':attribute deve ser uma data posterior a :date.',
    'after_or_equal' => ':attribute deve ser uma data posterior ou igual a :date.',
    'alpha' => ':attribute deve conter apenas letras.',
    'alpha_dash' => ':attribute deve conter apenas letras, números, traços e underlines.',
    'alpha_num' => ':attribute deve conter apenas letras e números.',
    'array' => ':attribute deve ser um array.',
    'before' => ':attribute deve ser uma data anterior a :date.',
    'before_or_equal' => ':attribute deve ser uma data anterior ou igual a :date.',
    'between' => [
        'numeric' => ':attribute dever estar entre :min e :max.',
        'file' => ':attribute dever estar entre :min e :max kilobytes.',
        'string' => ':attribute dever estar entre :min e :max caracteres.',
        'array' => ':attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação :attribute não combina.',
    'date' => ':attribute não é uma data válida.',
    'date_equals' => ':attribute deve ser uma data igual a :date.',
    'date_format' => ':attribute não combina com o formato :format.',
    'different' => ':attribute e :other devem ser diferentes.',
    'digits' => ':attribute deve ter :digits digitos.',
    'digits_between' => ':attribute dever estar entre :min e :max digitos.',
    'dimensions' => ':attribute tem dimensões inválidas.',
    'distinct' => ':attribute tem um valor duplicado.',
    'email' => ':attribute deve ser um endereço de email válido.',
    'ends_with' => ':attribute deve terminar com um dos seguintes: :values.',
    'exists' => ':attribute é(são) invalido(s).',
    'file' => ':attribute deve ser um arquivo.',
    'filled' => ':attribute deve ter um valor.',
    'gt' => [
        'numeric' => ':attribute deve ser maior que :value.',
        'file' => ':attribute deve ser maior que :value kilobytes.',
        'string' => ':attribute deve ser maior que :value caracteres.',
        'array' => ':attribute deve ter mais que :value itens.',
    ],
    'gte' => [
        'numeric' => ':attribute deve ser maior que ou igual a :value.',
        'file' => ':attribute deve ser maior que ou igual a :value kilobytes.',
        'string' => ':attribute deve ser maior que ou igual a :value caracteres.',
        'array' => ':attribute deve ter :value itens ou mais.',
    ],
    'image' => ':attribute deve ser uma imagem.',
    'in' => ':attribute é inválido.',
    'in_array' => 'O campo :attribute não existe em :other.',
    'integer' => ':attribute deve ser um inteiro.',
    'ip' => ':attribute deve ser um endereço de IP .',
    'ipv4' => ':attribute deve ser um endereço de IPv4.',
    'ipv6' => ':attribute deve ser um endereço de IPv6.',
    'json' => ':attribute deve ser uma string JSON.',
    'lt' => [
        'numeric' => ':attribute deve ser menor que :value.',
        'file' => ':attribute deve ser menor que :value kilobytes.',
        'string' => ':attribute deve ser menor que :value caracteres.',
        'array' => ':attribute must have menor que :value itens.',
    ],
    'lte' => [
        'numeric' => ':attribute deve ser menor que ou igual a :value.',
        'file' => ':attribute deve ser menor que ou igual a :value kilobytes.',
        'string' => ':attribute deve ser menor que ou igual a :value caracteres.',
        'array' => ':attribute must not have more than :value itens.',
    ],
    'max' => [
        'numeric' => ':attribute não deve ser maior que :max.',
        'file' => ':attribute não deve ser maior que :max kilobytes.',
        'string' => ':attribute não deve ser maior que :max caracteres.',
        'array' => ':attribute não deve ter mais que :max itens.',
    ],
    'mimes' => ':attribute deve ser um aquivo do tipo: :values.',
    'mimetypes' => ':attribute deve ser um aquivo do tipo: :values.',
    'min' => [
        'numeric' => ':attribute deve ter ao menos :min.',
        'file' => ':attribute deve ter ao menos :min kilobytes.',
        'string' => ':attribute deve ter ao menos :min caracteres.',
        'array' => ':attribute deve ter ao menos :min itens.',
    ],
    'multiple_of' => ':attribute deve ser um multiplo de :value.',
    'not_in' => ':attribute é inválido.',
    'not_regex' => 'O formato :attribute é inválido.',
    'numeric' => ':attribute deve ser um número.',
    'password' => 'A senha está incorreta.',
    'present' => ':attribute deve estar presente.',
    'regex' => 'O formato :attribute é inválido',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando :other is :value.',
    'required_unless' => ':O campo :attribute é obrigatório a menos que :other está em :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não estão presentes.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presente.',
    'same' => ':attribute e :other devem ser iguais.',
    'size' => [
        'numeric' => ':attribute deve ter :size.',
        'file' => ':attribute deve ter :size kilobytes.',
        'string' => ':attribute deve ter :size caracteres.',
        'array' => ':attribute deve ter :size itens.',
    ],
    'starts_with' => ':attribute deve começar com um dos seguintes: :values.',
    'string' => ':attribute deve ser uma string.',
    'timezone' => ':attribute deve ser um fuso-horário válido.',
    'unique' => ':attribute já está sendo utilizado.',
    'uploaded' => ':attribute falhou ao enviar.',
    'url' => 'O formato :attribute é inválido.',
    'uuid' => ':attribute deve ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
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
