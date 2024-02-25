<?php

return [

    "tableName" => "supervisoes_pesq_avancada",

    "updateFunction" => 'PesquisasAvancadasOps/updateSupervisoesPesquisaAvancada',

    "columns" => [
        "id_projeto" => [
            "type" => "string",
            "size" => 12
        ],
        "sequencia_supervisao" => [
            "type" => "smallInteger",
        ],
        "numero_usp_supervisor" => [
            "type" => "integer"
        ],
        "tipo_supervisao" => [
            "type" => "string",
            "size" => 40
        ],
        "data_inicio_supervisao" => [
            "type" => "date"
        ],
        "data_fim_supervisao" => [
            "type" => "date"
        ],
        "ultimo_supervisor_resp" => [
            "type" => "char",
            "size" => 1
        ]
    ],

    "primary" => [
        "key" => ["id_projeto", "sequencia_supervisao", "tipo_supervisao"],
        "keyName" => "supervisoes_pesq_avancada_primary"
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