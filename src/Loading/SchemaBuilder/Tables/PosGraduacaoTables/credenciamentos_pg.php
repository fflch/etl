<?php

return [

    "tableName" => "credenciamentos_pg",

    "updateFunction" => 'PosGraduacaoOps/updateCredenciamentosPG',

    "columns" => [
        "id_credenciamento" => [
            "type" => "char",
            "size" => 32
        ],
        "numero_usp" => [
            "type" => "integer"
        ],
        "codigo_area" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_area" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "codigo_programa" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_programa" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "nivel_credenciamento" => [
            "type" => "string",
            "size" => 16
        ],
        "tipo_credenciamento" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "situacao_credenciamento" => [
            "type" => "string",
            "size" => 12,
            "nullable" => true
        ],
        "data_inicio_validade" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_fim_validade" => [
            "type" => "date",
            "nullable" => true
        ],
        "ultimo_credenciamento_area" => [
            "type" => "char",
            "size" => 1
        ],
    ],

    "primary" => [
        "key" => ["id_credenciamento"]
    ],

    "foreign" => [
        //
    ]
];