<?php

return [

    "tableName" => "posgraduacoes",

    "updateFunction" => 'PosGraduacaoOps/updatePosGraduacoes',

    "columns" => [
        "id_posgraduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "numero_usp" => [
            "type" => "integer"
        ],
        "seq_programa" => [
            "type" => "tinyInteger"
        ],
        "tipo_matricula" => [
            "type" => "string",
            "size" => 24
        ],
        "nivel_programa" => [
            "type" => "string",
            "size" => 16,
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
        "data_selecao" => [
            "type" => "date"
        ],
        "data_primeira_matricula" => [
            "type" => "date",
            "nullable" => true
        ],
        "tipo_ultima_ocorrencia" => [
            "type" => "string",
            "size" => 48,
            "nullable" => true
        ],
        "data_ultima_ocorrencia" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_deposito_trabalho" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_aprovacao_trabalho" => [
            "type" => "date",
            "nullable" => true
        ]
    ],

    "primary" => [
        "key" => ["id_posgraduacao"]
    ],

    "foreign" => [
        //
    ]
];
