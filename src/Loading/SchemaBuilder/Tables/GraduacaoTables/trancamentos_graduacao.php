<?php

return [

    "tableName" => "trancamentos_graduacao",

    "updateFunction" => 'GraduacaoOps/updateTrancamentosGraduacao',

    "columns" => [
        "id_graduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "data_registro_inicio_tranc" => [
            "type" => "datetime"
        ],
        "periodo_inicio_trancamento" => [
            "type" => "char",
            "size" => 5
        ],
        "data_registro_fim_tranc" => [
            "type" => "datetime",
            "nullable" => true
        ],
        "periodo_fim_trancamento" => [
            "type" => "char",
            "size" => 5,
            "nullable" => true
        ],
        "semestres_trancados" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "sequencia_trancamento" => [
            "type" => "string",
            "size" => 48,
            "nullable" => true
        ],
    ],

    "primary" => [
        //
    ],
    
    "foreign" => [
        [
            "keys" => "id_graduacao",
            "references" => "id_graduacao",
            "on" => "graduacoes",
            "onDelete" => "cascade"
        ]
    ]
];