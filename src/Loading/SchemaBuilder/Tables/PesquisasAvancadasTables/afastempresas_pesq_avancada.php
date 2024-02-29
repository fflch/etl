<?php

return [

    "tableName" => "afastempresas_pesq_avancada",

    "updateFunction" => 'PesquisasAvancadasOps/updateAfastEmpresasPesquisaAvancada',

    "columns" => [
        "id_projeto" => [
            "type" => "string",
            "size" => 12
        ],
        "sequencia_periodo" => [
            "type" => "smallInteger",
        ],
        "seq_vinculo_empresa" => [
            "type" => 'tinyInteger'
        ],
        "nome_empresa" => [
            "type" => "string",
            "size" => 512
        ],
        "data_inicio_afastamento" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_fim_afastamento" => [
            "type" => "date",
            "nullable" => true
        ],
        "tipo_vinculo" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ]
    ],

    "primary" => [
        "key" => ["id_projeto", "sequencia_periodo", "seq_vinculo_empresa"],
        "keyName" => "afastamentos_empregaticios_primary"
    ],
    
    "foreign" => [
        [
            "keys" => ["id_projeto", "sequencia_periodo"],
            "references" => ["id_projeto", "sequencia_periodo"],
            "on" => "periodos_pesq_avancada",
            "onDelete" => "cascade"
        ],
    ]
];