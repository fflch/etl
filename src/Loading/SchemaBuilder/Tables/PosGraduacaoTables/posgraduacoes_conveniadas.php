<?php

return [

    "tableName" => "posgraduacoes_conveniadas",

    "updateFunction" => 'PosGraduacaoOps/updatePGConveniadas',

    "columns" => [
        "id_posgraduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "codigo_convenio" => [
            "type" => "integer"
        ],
        "sigla_convenio" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "nome_convenio" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_posgraduacao"]
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