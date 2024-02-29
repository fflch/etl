<?php

return [

    "tableName" => "notas_ingresso_graduacao",

    "updateFunction" => 'GraduacaoOps/updateNotasIngressoGraduacao',

    "columns" => [
        "id_graduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "codigo_prova" => [
            "type" => "smallInteger"
        ],
        "descricao_prova" => [
            "type" => "string",
            "size" => 256
        ],
        "pontos_obtidos" => [
            "type" => "decimal",
            "nullable" => true
        ],
        "pontos_maximo" => [
            "type" => "integer",
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