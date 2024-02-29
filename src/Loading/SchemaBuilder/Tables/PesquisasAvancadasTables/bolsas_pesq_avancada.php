<?php

return [

    "tableName" => "bolsas_pesq_avancada",

    "updateFunction" => 'PesquisasAvancadasOps/updateBolsasPesquisaAvancada',

    "columns" => [
        "id_projeto" => [
            "type" => "string",
            "size" => 12
        ],
        "sequencia_periodo" => [
            "type" => "smallInteger",
        ],
        "sequencia_fomento" => [
            "type" => "tinyInteger"
        ],
        "codigo_fomento" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "nome_fomento" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
        "data_inicio_fomento" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_fim_fomento" => [
            "type" => "date",
            "nullable" => true
        ],
        "id_fomento" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ]
    ],

    "primary" => [
        "key" => ["id_projeto", "sequencia_periodo", "sequencia_fomento"],
        "keyName" => "bolsas_pesq_avancada_primary"
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