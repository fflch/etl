<?php

return [

    "tableName" => "periodos_pesq_avancada",

    "updateFunction" => 'PesquisasAvancadasOps/updatePeriodosPesquisaAvancada',

    "columns" => [
        "id_projeto" => [
            "type" => "string",
            "size" => 12
        ],
        "sequencia_periodo" => [
            "type" => "smallInteger",
        ],
        "situacao_periodo" => [
            "type" => "string",
            "size" => 32
        ],
        "data_inicio_periodo" => [
            "type" => "date"
        ],
        "data_fim_periodo" => [
            "type" => "date",
            "nullable" => true
        ],
        "fonte_recurso" => [
            "type" => "string",
            "size" => 32
        ],
        "horas_semanais" => [
            "type" => "tinyInteger",
            "nullable" => true
        ]
    ],

    "primary" => [
        "key" => ["id_projeto", "sequencia_periodo"]
    ],
    
    "foreign" => [
        [
            "keys" => "id_projeto",
            "references" => "id_projeto",
            "on" => "pesquisas_avancadas",
            "onDelete" => "cascade"
        ],
    ]
];