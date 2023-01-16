<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class PosDocSchemas
{
    const alunos_posdoutorado = [

        "tableName" => "alunos_posdoutorado",

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

    const posdoutorados = [

        "tableName" => "posdoutorados",

        "columns" => [
            "idProjeto" => [
                "type" => "string",
                "size" => 12
            ],
            "numeroUSP" => [
                "type" => "integer"
            ],
            "dataInicioProjeto" => [
                "type" => "dateTime"
            ],
            "dataFimProjeto" => [
                "type" => "dateTime"
            ],
            "situacaoProjeto" => [
                "type" => "string",
                "size" => 16
            ],
            "codigoDepartamento" => [
                "type" => "integer"
            ],
            "nomeDepartamento" => [
                "type" => "string",
                "size" => 256
            ],
            "tituloProjeto" => [
                "type" => "string",
                "size" => 1024
            ],
            "palavrasChave" => [
                "type" => "string",
                "size" => "128"
            ],
            "codigoModalidade" => [
                "type" => "tinyInteger"
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
            //
        ]
    ];
}