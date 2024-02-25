<?php

return [

    "tableName" => "coordenadores_ccex",

    "updateFunction" => 'CEUOps/updateCoordenadoresCCEx',

    "columns" => [
        "numero_usp" => [
            "type" => "integer"
        ],
        "codigo_oferecimento" => [
            "type" => "char",
            "size" => 32
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