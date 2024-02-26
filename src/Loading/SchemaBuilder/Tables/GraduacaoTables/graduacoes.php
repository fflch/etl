<?php

return [

    "tableName" => "graduacoes",

    "updateFunction" => 'GraduacaoOps/updateGraduacoes',

    "columns" => [
        "id_graduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "numero_usp" => [
            "type" => "integer"
        ],
        "sequencia_grad" => [
            "type" => "tinyInteger"
        ],
        "situacao_curso" => [
            "type" => "string",
            "size" => 16
        ],
        "data_inicio_vinculo" => [
            "type" => "date"
        ],
        "data_fim_vinculo" => [
            "type" => "date",
            "nullable" => true
        ],
        "codigo_curso" => [
            "type" => "integer"
        ],
        "nome_curso" => [
            "type" => "string",
            "size" => 32
        ],
        "tipo_ingresso" => [
            "type" => "string",
            "size" => 64
        ],
        "categoria_ingresso" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ],
        "rank_ingresso" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "bacharelado" => [
            "type" => "char",
            "size" => 1
        ],
        "tipo_encerramento_bacharelado" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "data_encerramento_bacharelado" => [
            "type" => "date",
            "nullable" => true
        ],
        "licenciatura" => [
            "type" => "char",
            "size" => 1
        ],
        "tipo_encerramento_licenciatura" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "data_encerramento_licenciatura" => [
            "type" => "date",
            "nullable" => true
        ]
    ],

    "primary" => [
        "key" => ["id_graduacao"]
    ],
    
    "foreign" => [
        //
    ]
];