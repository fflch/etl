<?php

return [

    "tableName" => "ministrantes_graduacao",

    "updateFunction" => 'GraduacaoOps/updateMinistrantesGraduacao',

    "columns" => [
        "numero_usp" => [
            "type" => "integer"
        ],
        "id_turma" => [
            "type" => "char",
            "size" => 32
        ],
        "periodicidade_ministrante" => [
            "type" => "string",
            "size" => 24,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["numero_usp", "id_turma"]
    ],
    
    "foreign" => [
        [
            "keys" => "id_turma",
            "references" => "id_turma",
            "on" => "turmas_graduacao",
            "onDelete" => "cascade"
        ]
    ]
];