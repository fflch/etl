<?php

return [

    "tableName" => "orientacoes_posgraduacao",

    "updateFunction" => 'PosGraduacaoOps/updateOrientacoesPG',

    "columns" => [
        "id_posgraduacao" => [
            "type" => "char",
            "size" => "32"
        ],
        "numero_usp_orientador" => [
            "type" => "integer"
        ],
        "sequencia_orientacao" => [
            "type" => "tinyInteger"
        ],
        "tipo_orientacao" => [
            "type" => "string",
            "size" => "32"
        ],
        "data_inicio_orientacao" => [
            "type" => "date"
        ],
        "data_fim_orientacao" => [
            "type" => "date",
            "nullable" => true
        ],
        "ultimo_orientador" => [
            "type" => "char",
            "size" => "1"
        ],
        "orientacao_especifica" => [
            "type" => "char",
            "size" => "1",
            "nullable" => true
        ],
        "data_conversao_para_plena" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_conversao_para_especifica" => [
            "type" => "date",
            "nullable" => true
        ],
    ],

    "primary" => [
        //
    ],

    "foreign" => [
        [
            "keys" => "id_posgraduacao",
            "references" => "id_posgraduacao",
            "on" => "posgraduacoes",
            "onDelete" => "cascade"
        ],
    ]
];