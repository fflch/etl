<?php

return [

    "tableName" => "vinculos_servidores",

    "updateFunction" => 'ServidoresOps/updateVinculosServidores',

    "columns" => [
        "id_vinculo" => [
            "type" => "char",
            "size" => 32
        ],
        "numero_usp" => [
            "type" => "integer"
        ],
        "vinculo" => [
            "type" => "string",
            "size" => 48
        ],
        "situacao_atual" => [
            "type" => "string",
            "size" => 24
        ],
        "data_inicio_vinculo" => [
            "type" => "date"
        ],
        "data_fim_vinculo" => [
            "type" => "date",
            "nullable" => true
        ],
        "cod_ultimo_setor" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_ultimo_setor" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "ambito_funcao" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ],
        "classe" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ],
        "referencia" => [
            "type" => "string",
            "size" => 12,
            "nullable" => true
        ],
        "tipo_jornada" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "tipo_ingresso" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "data_ultima_alteracao_funcional" => [
            "type" => "date",
            "nullable" => true
        ],
        "ultima_ocorrencia" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "data_inicio_ultima_ocorrencia" => [
            "type" => "date",
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_vinculo"]
    ],
    
    "foreign" => [
        //
    ]
];