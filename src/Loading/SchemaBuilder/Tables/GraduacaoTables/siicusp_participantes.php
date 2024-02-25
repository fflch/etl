<?php

return [

    "tableName" => "siicusp_participantes",

    "updateFunction" => 'GraduacaoOps/updateSiicuspParticipantes',

    "columns" => [
        "id_trabalho" => [
            "type" => "string",
            "size" => 12
        ],
        "tipo_participante" => [
            "type" => "string",
            "size" => 32
        ],
        "numero_usp" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_participante" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "codigo_unidade" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "sigla_unidade" => [
            "type" => "string",
            "size" => 24,
            "nullable" => true
        ],
        "codigo_departamento" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_departamento" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
        "participante_apresentador" => [
            "type" => "char",
            "size" => 1
        ]
    ],

    "primary" => [
        //
    ],
    
    "foreign" => [
        [
            "keys" => "id_trabalho",
            "references" => "id_trabalho",
            "on" => "siicusp_trabalhos",
            "onDelete" => "cascade"
        ]
    ]
];