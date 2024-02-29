<?php

return [

    "tableName" => "pessoas",

    "updateFunction" => 'PessoasOps/updatePessoas',

    "columns" => [
        "numero_usp" => [
            "type" => "integer"
        ],
        "nome" => [
            "type" => "string",
            "size" => 256
        ],
        "data_nascimento" => [
            "type" => "date"
        ],
        "data_falecimento" => [
            "type" => "date",
            "nullable" => true
        ],
        "email" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "nacionalidade" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "cidade_nascimento" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "estado_nascimento" => [
            "type" => "string",
            "size" => 2,
            "nullable" => true
        ],
        "pais_nascimento" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "raca" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "sexo" => [
            "type" => "string",
            "size" => 1,
            "nullable" => true
        ],
        "orientacao_sexual" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "identidade_genero" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "situacao_vacinal_covid" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ],
        "cpf" => [
            "type" => "char",
            "size" => 11,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["numero_usp"]
    ],
    
    "foreign" => [
        //
    ]
];