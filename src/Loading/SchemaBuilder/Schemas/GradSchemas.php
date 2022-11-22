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
}