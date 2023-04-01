<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class PosDocSchemas
{
    const projetos_posdoc = [

        "tableName" => "projetos_posdoc",

        "columns" => [
            "id_projeto" => [
                "type" => "string",
                "size" => 12
            ],
            "programa" => [
                "type" => "char",
                "size" => 2
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "data_inicio_projeto" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_fim_projeto" => [
                "type" => "date",
                "nullable" => true
            ],
            "situacao_projeto" => [
                "type" => "string",
                "size" => 16
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

    const periodos_posdoc = [

        "tableName" => "periodos_posdoc",

        "columns" => [
            "id_projeto" => [
                "type" => "string",
                "size" => 12
            ],
            "sequencia_periodo" => [
                "type" => "smallInteger",
            ],
            "data_inicio_periodo" => [
                "type" => "date"
            ],
            "data_fim_periodo" => [
                "type" => "date",
                "nullable" => true
            ],
            "situacao_periodo" => [
                "type" => "string",
                "size" => 32
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
                "on" => "projetos_posdoc",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const bolsas_posdoc = [

        "tableName" => "bolsas_posdoc",

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
            "keyName" => "bolsasposdoc_primary"
        ],
        
        "foreign" => [
            [
                "keys" => ["id_projeto", "sequencia_periodo"],
                "references" => ["id_projeto", "sequencia_periodo"],
                "on" => "periodos_posdoc",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const afastempresas_posdoc = [

        "tableName" => "afastempresas_posdoc",

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
                "on" => "periodos_posdoc",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const supervisoes_posdoc = [

        "tableName" => "supervisoes_posdoc",

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
            "nome_supervisor" => [
                "type" => "string",
                "size" => 256
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
            "keyName" => "supervisoes_posdoc_primary"
        ],
        
        "foreign" => [
            [
                "keys" => "id_projeto",
                "references" => "id_projeto",
                "on" => "projetos_posdoc",
                "onDelete" => "cascade"
            ],
        ]
    ];
}