<?php

return [

    "tableName" => "bolsas_ic",

    "updateFunction" => 'GraduacaoOps/updateBolsasIC',

    "columns" => [
        "id_projeto" => [
            "type" => "string",
            "size" => 12
        ],
        "sequencia_fomento" => [
            "type" => "integer"
        ],
        "nome_fomento" => [
            "type" => "string",
            "size" => 128
        ],
        "fomento_edital" => [
            "type" => "integer",
            "nullable" => true
        ],
        "data_inicio_fomento" => [
            "type" => "Date",
            "nullable" => true
        ],
        "data_fim_fomento" => [
            "type" => "Date",
            "nullable" => true
        ]
    ],

    "primary" => [
        //
    ],
    
    "foreign" => [
        [
            "keys" => "id_projeto",
            "references" => "id_projeto",
            "on" => "iniciacoes",
            "onDelete" => "cascade"
        ]
    ]
];