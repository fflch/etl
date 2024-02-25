<?php

return [

    "tableName" => "professores_visitantes",

    "updateFunction" => 'ServidoresOps/updateProfessoresVisitantes',

    "columns" => [
        "numero_usp" => [
            "type" => "integer"
        ],
        "data_inicio_intercambio" => [
            "type" => "date"
        ],
        "data_fim_intercambio" => [
            "type" => "date"
        ],
        "tipo_intercambio" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "codigo_instituicao_origem" => [
            "type" => "integer",
            "nullable" => true
        ],
        "sigla_instituicao_origem" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "nome_instituicao_origem" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "tipo_ingresso_intercambio" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "nome_programa_intercambio" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "nome_rede_intercambio" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ],
        "responsavel_numero_usp" => [
            "type" => "integer"
        ],
        "responsavel_unidade" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "responsavel_codigo_setor" => [
            "type" => "integer",
            "nullable" => true
        ],
        "responsavel_nome_setor" => [
            "type" => "string",
            "size" => 64,
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