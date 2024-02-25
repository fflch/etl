<?php

return [

    "tableName" => "habilitacoes",

    "updateFunction" => 'GraduacaoOps/updateHabilitacoes',

    "columns" => [
        "id_graduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "codigo_curso" => [
            "type" => "integer"
        ],
        "codigo_habilitacao" => [
            "type" => "integer"
        ],
        "nome_habilitacao" => [
            "type" => "string",
            "size" => 64
        ],
        "tipo_habilitacao" => [
            "type" => "string",
            "size" => 32
        ],
        "periodo_habilitacao" => [
            "type" => "string",
            "size" => 32
        ],
        "data_inicio_habilitacao" => [
            "type" => "date"
        ],
        "data_fim_habilitacao" => [
            "type" => "date",
            "nullable" => true
        ],
        "tipo_encerramento" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "data_colacao_grau" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_expedicao_diploma" => [
            "type" => "date",
            "nullable" => true
        ],
    ],

    "primary" => [
        //
    ],
    
    "foreign" => [
        [
            "keys" => "id_graduacao",
            "references" => "id_graduacao",
            "on" => "graduacoes",
            "onDelete" => "cascade"
        ]
    ]
];