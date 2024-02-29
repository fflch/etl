<?php

return [

    "tableName" => "siicusp_trabalhos",

    "updateFunction" => 'GraduacaoOps/updateSiicuspTrabalhos',

    "columns" => [
        "id_trabalho" => [
            "type" => "string",
            "size" => 12
        ],
        "titulo_trabalho" => [
            "type" => "string",
            "size" => 512
        ],
        "id_projeto_ic" => [
            "type" => "string",
            "size" => 12,
            "nullable" => true
        ],
        "edicao_siicusp" => [
            "type" => "smallInteger",
        ],
        "situacao_inscricao" => [
            "type" => "string",
            "size" => 24
        ],
        "situacao_apresentacao" => [
            "type" => "string",
            "size" => 24,
            "nullable" => true
        ],
        "prox_etapa_recomendado" => [
            "type" => "char",
            "size" => 1
        ],
        "prox_etapa_apresentado" => [
            "type" => "char",
            "size" => 1
        ],
        "mencao_honrosa" => [
            "type" => "char",
            "size" => 1
        ],
        "codigo_dpto_orientador" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_dpto_orientador" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ]
    ],

    "primary" => [
        "key" => ["id_trabalho"]
    ],
    
    "foreign" => [
        //
    ]
];