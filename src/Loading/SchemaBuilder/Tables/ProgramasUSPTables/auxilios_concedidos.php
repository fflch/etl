<?php

return [

    "tableName" => "auxilios_concedidos",

    "updateFunction" => 'ProgramasUSPOps/updateAuxiliosConcedidos',

    "columns" => [
        "id_concessao_auxilio" => [
            "type" => "char",
            "size" => 32
        ],
        "codigo_auxilio" => [
            "type" => "smallInteger"
        ],
        "nome_auxilio" => [
            "type" => "string",
            "size" => 60
        ],
        "numero_usp" => [
            "type" => "integer",
            "nullable" => true
        ],
        "situacao_auxilio" => [
            "type" => "string",
            "size" => 12
        ],
        "data_inicio_auxilio" => [
            "type" => "date"
        ],
        "data_fim_auxilio" => [
            "type" => "date"
        ],
        "justificativa_cancelamento_auxilio" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
        "tipo_vinculo_beneficiario" => [
            "type" => "string",
            "size" => 40,
            "nullable" => true
        ],
        "id_graduacao_beneficiario" => [
            "type" => "char",
            "size" => 32,
            "nullable" => true
        ],
        "nivel_pg_beneficiario" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "cota_mensal_prevista" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "valor_auxilio_especifico" => [
            "type" => "decimal",
            "nullable" => true
        ],
        "fonte_pagadora_usp" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "parte_papfe" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "exige_avaliacao_socioeconomica" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_concessao_auxilio"]
    ],
    
    "foreign" => [
        //
    ]
];