<?php

return [

    "tableName" => "inscricoes_ccex",

    "updateFunction" => 'CEUOps/updateInscricoesCCEx',

    "columns" => [
        "codigo_oferecimento" => [
            "type" => "char",
            "size" => 32
        ],
        "numero_ceu" => [
            "type" => "integer",
            "nullable" => true
        ],
        "data_inscricao" => [
            "type" => "dateTime",
            "nullable" => true
        ],
        "situacao_inscricao" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true //corrigir
        ],
        "origem_inscricao" => [
            "type" => "string",
            "size" => 16,
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