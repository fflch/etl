<?php

return [

    "tableName" => "coordenadores_posgraduacao",

    "updateFunction" => 'PosGraduacaoOps/updateCoordenadoresPG',

    "columns" => [
        "numero_usp" => [
            "type" => "integer",
        ],
        "funcao" => [
            "type" => "string",
            "size" => 16
        ],
        "codigo_programa" => [
            "type" => "integer"
        ],
        "nome_programa" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "data_inicio_funcao" => [
            "type" => "date"
        ],
        "data_fim_funcao" => [
            "type" => "date",
            "nullable" => true
        ],
    ],

    "primary" => [
        //
    ],

    "foreign" => [
        //
    ]
];