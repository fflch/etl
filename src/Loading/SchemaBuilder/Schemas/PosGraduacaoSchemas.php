<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class PosGraduacaoSchemas
{
    const posgraduacoes = [

        "tableName" => "posgraduacoes",

        "columns" => [
            "id_pos_graduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "seq_programa" => [
                "type" => "tinyInteger"
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
                "size" => 32,
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
            "key" => ["id_pos_graduacao"]
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
}