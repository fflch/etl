<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class GradSchemas
{
    const alunos_graduacao = [

        "tableName" => "alunos_graduacao",

        "columns" => [
            "numeroUSP" => [
                "type" => "integer"
            ],
            "nomeAluno" => [
                "type" => "string",
                "size" => 256
            ],
            "anoNascimento" => [
                "type" => "smallInteger"
            ],
            "nacionalidade" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "cidadeNascimento" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "estadoNascimento" => [
                "type" => "string",
                "size" => 2,
                "nullable" => true
            ],
            "paisNascimento" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "raca" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "sexo" => [
                "type" => "string",
                "size" => 1,
                "nullable" => true
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            "numeroUSP"
        ],
        
        "foreign" => [
            //
        ]
    ];

    const graduacoes = [

        "tableName" => "graduacoes",

        "columns" => [
            "idGraduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "numeroUSP" => [
                "type" => "integer"
            ],
            "sequenciaCurso" => [
                "type" => "tinyInteger"
            ],
            "situacao" => [
                "type" => "string",
                "size" => 16
            ],
            "dataInicioVinculo" => [
                "type" => "dateTime"
            ],
            "dataFimVinculo" => [
                "type" => "dateTime",
                "nullable" => true
            ],
            "codigoCurso" => [
                "type" => "integer"
            ],
            "nomeCurso" => [
                "type" => "string",
                "size" => 32
            ],
            "tipoIngresso" => [
                "type" => "string",
                "size" => 64
            ],
            "categoriaIngresso" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "rankIngresso" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "tipoEncerramento" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            "idGraduacao"
        ],
        
        "foreign" => [
            [
                "keys" => "numeroUSP",
                "references" => "numeroUSP",
                "on" => "alunos_graduacao",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const habilitacoes = [

        "tableName" => "habilitacoes",

        "columns" => [
            "idGraduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "codigoCurso" => [
                "type" => "integer"
            ],
            "codigoHabilitacao" => [
                "type" => "integer"
            ],
            "nomeHabilitacao" => [
                "type" => "string",
                "size" => 64
            ],
            "tipoHabilitacao" => [
                "type" => "string",
                "size" => 32
            ],
            "periodoHabilitacao" => [
                "type" => "string",
                "size" => 32
            ],
            "dataInicioHabilitacao" => [
                "type" => "dateTime"
            ],
            "dataFimHabilitacao" => [
                "type" => "dateTime",
                "nullable" => true
            ],
            "tipoEncerramento" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [

        ],
        
        "foreign" => [
            [
                "keys" => "idGraduacao",
                "references" => "idGraduacao",
                "on" => "graduacoes",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const iniciacoes = [

        "tableName" => "iniciacoes",

        "columns" => [
            "idProjeto" => [
                "type" => "string",
                "size" => 12
            ],
            "numeroUSP" => [
                "type" => "integer",
                "nullable" => true
            ],
            "statusProjeto" => [
                "type" => "string",
                "size" => 32
            ],
            "anoProjeto" => [
                "type" => "smallInteger"
            ],
            "codigoDepartamento" => [
                "type" => "integer"
            ],
            "nomeDepartamento" => [
                "type" => "string",
                "size" => 64
            ],
            "dataInicioProjeto" => [
                "type" => "dateTime",
                "nullable" => true
            ],
            "dataFimProjeto" => [
                "type" => "dateTime",
                "nullable" => true
            ],
            "numeroUSPorientador" => [
                "type" => "integer",
                "nullable" => true
            ],
            "tituloProjeto" => [
                "type" => "string",
                "size" => 256
            ],
            "palavrasChave" => [
                "type" => "string",
                "size" => 128
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            "idProjeto"
        ],
        
        "foreign" => [
            [
                "keys" => "numeroUSP",
                "references" => "numeroUSP",
                "on" => "alunos_graduacao",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const bolsasIC = [

        "tableName" => "bolsas_ic",

        "columns" => [
            "idProjeto" => [
                "type" => "string",
                "size" => 12
            ],
            "sequenciaBolsa" => [
                "type" => "integer"
            ],
            "nomePrograma" => [
                "type" => "string",
                "size" => 128
            ],
            "bolsaEdital" => [
                "type" => "integer",
                "nullable" => true
            ],
            "dataInicioBolsa" => [
                "type" => "DateTime",
                "nullable" => true
            ],
            "dataFimBolsa" => [
                "type" => "DateTime",
                "nullable" => true
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [

        ],
        
        "foreign" => [
            [
                "keys" => "idProjeto",
                "references" => "idProjeto",
                "on" => "iniciacoes",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const questoes_questionario = [

        "tableName" => "questoes_questionario",

        "columns" => [
            "idQuestao" => [
                "type" => "string",
                "size" => 12
            ],
            "descricaoQuestao" => [
                "type" => "string",
                "size" => 512
            ],
            "codigoAlternativa" => [
                "type" => "tinyInteger"
            ],
            "descricaoAlternativa" => [
                "type" => "string",
                "size" => 1024,
                "nullable" => true
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            'idQuestao', 'codigoAlternativa'
        ],
        
        "foreign" => [
            //
        ]
    ];

    const respostas_questionario = [

        "tableName" => "respostas_questionario",

        "columns" => [
            "idGraduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "idQuestao" => [
                "type" => "string",
                "size" => 12
            ],
            "alternativaEscolhida" => [
                "type" => "integer"
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            [
                "keys" => "idGraduacao",
                "references" => "idGraduacao",
                "on" => "graduacoes",
                "onDelete" => "cascade"
            ],
            [
                "keys" => "idQuestao",
                "references" => "idQuestao",
                "on" => "questoes_questionario",
                "onDelete" => "cascade"
            ]
        ]
    ];
}