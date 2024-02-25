<?php

return[

    "tableName" => "matriculas_ccex",

    "updateFunction" => 'CEUOps/updateMatriculasCCEx',

    "columns" => [
        "codigo_matricula_ceu" => [
            "type" => "integer"
        ],
        "numero_usp" => [
            "type" => "integer"
        ],
        "codigo_oferecimento" => [
            "type" => "char",
            "size" => 32
        ],
        "data_matricula" => [
            "type" => "dateTime"
        ],
        "situacao_matricula" => [
            "type" => "string",
            "size" => 16
        ],
        "data_inicio_curso" => [
            "type" => "date"
        ],
        "data_fim_curso" => [
            "type" => "date"
        ],
        "frequencia_aluno" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "conceito_final_aluno" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["codigo_matricula_ceu"]
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