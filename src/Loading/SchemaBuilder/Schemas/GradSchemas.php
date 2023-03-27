<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class GradSchemas
{
    const graduacoes = [

        "tableName" => "graduacoes",

        "columns" => [
            "id_graduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "sequencia_curso" => [
                "type" => "tinyInteger"
            ],
            "situacao_curso" => [
                "type" => "string",
                "size" => 16
            ],
            "data_inicio_vinculo" => [
                "type" => "date"
            ],
            "data_fim_vinculo" => [
                "type" => "date",
                "nullable" => true
            ],
            "codigo_curso" => [
                "type" => "integer"
            ],
            "nome_curso" => [
                "type" => "string",
                "size" => 32
            ],
            "tipo_ingresso" => [
                "type" => "string",
                "size" => 64
            ],
            "categoria_ingresso" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "rank_ingresso" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "tipo_encerramento_bacharel" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "data_encerramento_bacharel" => [
                "type" => "datetime",
                "nullable" => true
            ]
        ],

        "primary" => [
            "key" => ["id_graduacao"]
        ],
        
        "foreign" => [
            [
                "keys" => "numero_usp",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const habilitacoes = [

        "tableName" => "habilitacoes",

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
            ]
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

    const iniciacoes = [

        "tableName" => "iniciacoes",

        "columns" => [
            "id_projeto" => [
                "type" => "string",
                "size" => 12
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "situacao_projeto" => [
                "type" => "string",
                "size" => 32
            ],
            "ano_projeto" => [
                "type" => "smallInteger"
            ],
            "codigo_departamento" => [
                "type" => "integer"
            ],
            "nome_departamento" => [
                "type" => "string",
                "size" => 64
            ],
            "data_inicio_projeto" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_fim_projeto" => [
                "type" => "date",
                "nullable" => true
            ],
            "numero_usp_orientador" => [
                "type" => "integer",
                "nullable" => true
            ],
            "titulo_projeto" => [
                "type" => "string",
                "size" => 256
            ],
            "palavras_chave" => [
                "type" => "string",
                "size" => 128
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
            ]
        ]
    ];

    const bolsasIC = [

        "tableName" => "bolsas_ic",

        "columns" => [
            "id_projeto" => [
                "type" => "string",
                "size" => 12
            ],
            "sequencia_bolsa" => [
                "type" => "integer"
            ],
            "nome_programa" => [
                "type" => "string",
                "size" => 128
            ],
            "bolsa_edital" => [
                "type" => "integer",
                "nullable" => true
            ],
            "data_inicio_bolsa" => [
                "type" => "Date",
                "nullable" => true
            ],
            "data_fim_bolsa" => [
                "type" => "Date",
                "nullable" => true
            ]
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            [
                "keys" => "id_projeto",
                "references" => "id_projeto",
                "on" => "iniciacoes",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const questionario_questoes = [

        "tableName" => "questionario_questoes",

        "columns" => [
            "id_questao" => [
                "type" => "string",
                "size" => 12
            ],
            "descricao_questao" => [
                "type" => "string",
                "size" => 512
            ],
            "codigo_alternativa" => [
                "type" => "tinyInteger"
            ],
            "descricao_alternativa" => [
                "type" => "string",
                "size" => 1024,
                "nullable" => true
            ]
        ],

        "primary" => [
            "key" => ['id_questao', 'codigo_alternativa']
        ],
        
        "foreign" => [
            //
        ]
    ];

    const questionario_respostas = [

        "tableName" => "questionario_respostas",

        "columns" => [
            "id_graduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "id_questao" => [
                "type" => "string",
                "size" => 12
            ],
            "alternativa_escolhida" => [
                "type" => "tinyInteger"
            ]
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
            ],
            [
                "keys" => ["id_questao", "alternativa_escolhida"],
                "references" => ["id_questao", "codigo_alternativa"],
                "on" => "questionario_questoes",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const siicusp_trabalhos = [

        "tableName" => "siicusp_trabalhos",

        "columns" => [
            "id_trabalho" => [
                "type" => "string",
                "size" => 12
            ],
            "titulo_trabalho" => [
                "type" => "string",
                "size" => 512
            ],
            "id_projeto_ic" => [
                "type" => "string",
                "size" => 12,
                "nullable" => true
            ],
            "edicao_siicusp" => [
                "type" => "smallInteger",
            ],
            "situacao_inscricao" => [
                "type" => "string",
                "size" => 24
            ],
            "situacao_apresentacao" => [
                "type" => "string",
                "size" => 24,
                "nullable" => true
            ],
            "prox_etapa_recomendado" => [
                "type" => "boolean",
                "nullable" => true
            ],
            "prox_etapa_apresentado" => [
                "type" => "boolean",
                "nullable" => true
            ],
            "mencao_honrosa" => [
                "type" => "boolean",
                "nullable" => true
            ],
            "codigo_dpto_orientador" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_dpto_orientador" => [
                "type" => "string",
                "size" => 256,
                "nullable" => true
            ]
        ],

        "primary" => [
            "key" => ["id_trabalho"]
        ],
        
        "foreign" => [
            //
        ]
    ];

    const siicusp_participantes = [

        "tableName" => "siicusp_participantes",

        "columns" => [
            'id_trabalho' => [
                "type" => "string",
                "size" => 12
            ],
            'tipo_participante' => [
                "type" => "string",
                "size" => 32
            ],
            'numero_usp' => [
                "type" => "integer",
                "nullable" => true
            ],
            'nome_participante' => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            'codigo_unidade' => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            'sigla_unidade' => [
                "type" => "string",
                "size" => 24,
                "nullable" => true
            ],
            'codigo_departamento' => [
                "type" => "integer",
                "nullable" => true
            ],
            'nome_departamento' => [
                "type" => "string",
                "size" => 256,
                "nullable" => true
            ],
            'participante_apresentador' => [
                "type" => "boolean"
            ]
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            [
                "keys" => "id_trabalho",
                "references" => "id_trabalho",
                "on" => "siicusp_trabalhos",
                "onDelete" => "cascade"
            ]
        ]
    ];
}