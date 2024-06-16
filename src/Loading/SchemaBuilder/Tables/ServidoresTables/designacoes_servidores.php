<?php

return [

    "tableName" => "designacoes_servidores",

    "updateFunction" => 'ServidoresOps/updateDesignacoesServidores',

    "columns" => [
        "id_vinculo" => [
            "type" => "char",
            "size" => 32
        ],
        "data_inicio_designacao" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_fim_designacao" => [
            "type" => "date",
            "nullable" => true
        ],
        "codigo_setor_designacao" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_setor_designacao" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "nome_funcao" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "tipo_designacao" => [
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
            "keys" => "id_vinculo",
            "references" => "id_vinculo",
            "on" => "vinculos_servidores",
            "onDelete" => "cascade"
        ],
    ]
];
