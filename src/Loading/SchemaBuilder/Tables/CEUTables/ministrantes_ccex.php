<?php

return [

    "tableName" => "ministrantes_ccex",

    "updateFunction" => 'CEUOps/updateMinistrantesCCEx',

    "columns" => [
        "numero_usp" => [
            "type" => "integer"
        ],
        "codigo_oferecimento" => [
            "type" => "char",
            "size" => 32
        ],
        "turma" => [
            "type" => "integer"
        ],
        "funcao" => [
            "type" => "string",
            "size" => 24
        ],
        "forma_exercicio" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "carga_horaria_horas" => [
            "type" => "float",
            "nullable" => true
        ],
        "data_inicio_turma" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_fim_turma" => [
            "type" => "date",
            "nullable" => true
        ],
    ],

    "primary" => [
        //
    ],
    
    "foreign" => [
        [
            "keys" => "codigo_oferecimento",
            "references" => "codigo_oferecimento",
            "on" => "oferecimentos_ccex",
            "onDelete" => "cascade"
        ]
    ]
];