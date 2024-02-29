<?php

return [

    "tableName" => "ministrantes_posgraduacao",

    "updateFunction" => 'PosGraduacaoOps/updateMinistrantesPG',

    "columns" => [
        "numero_usp" => [
            "type" => "integer"
        ],
        "id_turma" => [
            "type" => "char",
            "size" => 32
        ],
    ],

    "primary" => [
        //
    ],

    "foreign" => [
        [
            "keys" => ["id_turma"],
            "references" => ["id_turma"],
            "on" => "turmas_posgraduacao",
            "onDelete" => "cascade"
        ]
    ]
];