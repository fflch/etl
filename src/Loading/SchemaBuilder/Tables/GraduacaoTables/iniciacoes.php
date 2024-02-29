<?php

return [

    "tableName" => "iniciacoes",

    "updateFunction" => 'GraduacaoOps/updateIniciacoes',

    "columns" => [
        "id_projeto" => [
            "type" => "string",
            "size" => 12
        ],
        "numero_usp" => [
            "type" => "integer"
        ],
        "situacao_projeto" => [
            "type" => "string",
            "size" => 32
        ],
        "data_inicio_projeto" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_fim_projeto" => [
            "type" => "date",
            "nullable" => true
        ],
        "ano_projeto" => [
            "type" => "smallInteger"
        ],
        "codigo_departamento" => [
            "type" => "integer"
        ],
        "nome_departamento" => [
            "type" => "string",
            "size" => 64
        ],
        "numero_usp_orientador" => [
            "type" => "integer",
            "nullable" => true
        ],
        "titulo_projeto" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
        "palavras_chave" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ]
    ],

    "primary" => [
        "key" => ["id_projeto"]
    ],
    
    "foreign" => [
        //
    ]
];
