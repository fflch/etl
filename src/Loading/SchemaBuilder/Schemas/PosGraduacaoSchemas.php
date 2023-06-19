<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class PosGraduacaoSchemas
{
    const posgraduacoes = [

        "tableName" => "posgraduacoes",

        "columns" => [
            "id_posgraduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "seq_programa" => [
                "type" => "tinyInteger"
            ],
            "tipo_vinculo" => [
                "type" => "string",
                "size" => 16
            ],
            "nivel_programa" => [
                "type" => "char",
                "size" => 2
            ],
            "codigo_area" => [
                "type" => "integer"
            ],
            "nome_area" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "codigo_programa" => [
                "type" => "integer"
            ],
            "nome_programa" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "data_selecao" => [
                "type" => "date"
            ],
            "primeira_matricula" => [
                "type" => "date",
                "nullable" => true
            ],
            "tipo_ultima_ocorrencia" => [
                "type" => "string",
                "size" => 48,
                "nullable" => true
            ],
            "data_ultima_ocorrencia" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_deposito_trabalho" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_aprovacao_trabalho" => [
                "type" => "date",
                "nullable" => true
            ]
        ],

        "primary" => [
            "key" => ["id_posgraduacao"]
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

    const defesas_posgraduacao = [

        "tableName" => "defesas_posgraduacao",

        "columns" => [
            "id_posgraduacao" => [
                "type" => "char",
                "size" => 35
            ],
            "data_defesa" => [
                "type" => "date",
                "nullable" => true // ver
            ],
            "local_defesa" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "mencao_honrosa" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "titulo_trabalho" => [
                "type" => "string",
                "size" => 512,
                "nullable" => true // ver
            ],
        ],

        "primary" => [
            "key" => ["id_posgraduacao"]
        ],
        
        "foreign" => [
            // ver
            // [
            //     "keys" => "id_posgraduacao",
            //     "references" => "id_posgraduacao",
            //     "on" => "posgraduacoes",
            //     "onDelete" => "cascade"
            // ],
        ]
    ];
}