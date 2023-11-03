<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class PesquisasAvancadasSchemas
{
    const pesquisas_avancadas = [

        "tableName" => "pesquisas_avancadas",

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
            [
                "keys" => "numero_usp",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const periodos_pesq_avancada = [

        "tableName" => "periodos_pesq_avancada",

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

    const bolsas_pesq_avancada = [

        "tableName" => "bolsas_pesq_avancada",

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

    const afastempresas_pesq_avancada = [

        "tableName" => "afastempresas_pesq_avancada",

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

    const supervisoes_pesq_avancada = [

        "tableName" => "supervisoes_pesq_avancada",

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
}