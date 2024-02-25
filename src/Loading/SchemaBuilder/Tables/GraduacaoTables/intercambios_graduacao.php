<?php

return [

    "tableName" => "intercambios_graduacao",

    "updateFunction" => 'GraduacaoOps/updateIntercambiosGraduacao',

    "columns" => [
        "id_graduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "numero_usp" => [
            "type" => "integer",
        ],
        "modalidade_intercambio" => [
            "type" => "string",
            "size" => 24
        ],
        "situacao_intercambio" => [
            "type" => "string",
            "size" => 32
        ],
        "data_inicio_intercambio" => [
            "type" => "date"
        ],
        "data_fim_intercambio" => [
            "type" => "date"
        ],
        "data_desistencia" => [
            "type" => "date",
            "nullable" => true
        ],
        "houve_prorrogacao" => [
            "type" => "char",
            "size" => 1
        ],
        "codigo_instituicao" => [
            "type" => "integer"
        ],
        "sigla_instituicao" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "nome_instituicao" => [
            "type" => "string",
            "size" => 128
        ],
        "tipo_ingresso_intercambio" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "codigo_edital_intercambio" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_programa_intercambio" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
        "nome_rede_intercambio" => [
            "type" => "string",
            "size" => 256,
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