<?php

return [

    "tableName" => "pesquisas_avancadas",

    "updateFunction" => 'PesquisasAvancadasOps/updatePesquisasAvancadas',

    "columns" => [
        "id_projeto" => [
            "type" => "string",
            "size" => 12
        ],
        "modalidade" => [
            "type" => "char",
            "size" => 2
        ],
        "numero_usp" => [
            "type" => "integer"
        ],
        "situacao_projeto" => [
            "type" => "string",
            "size" => 16
        ],
        "data_inicio_projeto" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_fim_projeto" => [
            "type" => "date",
            "nullable" => true
        ],
        "motivo_cancelamento" => [
            "type" => "string",
            "size" => 100,
            "nullable" => true
        ],
        "descricao_cancelamento" => [
            "type" => "string",
            "size" => 256,
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
        "titulo_projeto" => [
            "type" => "string",
            "size" => 1024
        ],
        "area_cnpq" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "palavras_chave" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ]
    ],

    "primary" => [
        "key" => ["id_projeto"]
    ],
    
    "foreign" => [
        //
    ]
];