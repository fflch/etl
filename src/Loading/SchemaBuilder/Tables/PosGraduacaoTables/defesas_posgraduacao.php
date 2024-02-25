<?php

return [

    "tableName" => "defesas_posgraduacao",

    "updateFunction" => 'PosGraduacaoOps/updateDefesasPG',

    "columns" => [
        "id_defesa" => [
            "type" => "char",
            "size" => 32
        ],
        "id_posgraduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "data_defesa" => [
            "type" => "date"
        ],
        "local_defesa" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ],
        // "resultado_defesa" => [
        //     "type" => "string",
        //     "size" => 32
        // ], // ver como extrair info
        "mencao_honrosa" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "titulo_trabalho" => [
            "type" => "string",
            "size" => 512,
            "nullable" => true // ver trabalhos com titulo = null
        ],
    ],

    "primary" => [
        "key" => ["id_defesa"]
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