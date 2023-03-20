<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class PosGradSchemas
{
    const posgraduacoes = [

        "tableName" => "posgraduacoes",

        "columns" => [
            'idPosGraduacao' => [
                "type" => "char",
                "size" => 32
            ],
            'numeroUSP' => [
                "type" => "integer"
            ],
            'seqPrograma' => [
                "type" => "tinyInteger"
            ],
            'nivelPrograma' => [
                "type" => "char",
                "size" => 2
            ],
            'codigoArea' => [
                "type" => "integer"
            ],
            'nomeArea' => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            'codigoPrograma' => [
                "type" => "integer"
            ],
            'nomePrograma' => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            'dataSelecao' => [
                "type" => "date"
            ],
            'primeiraMatricula' => [
                "type" => "date",
                "nullable" => true
            ],
            'tipoUltimaOcorrencia' => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            'dataUltimaOcorrencia' => [
                "type" => "date",
                "nullable" => true
            ],
            'dataDepositoTrabalho' => [
                "type" => "date",
                "nullable" => true
            ],
            'dataAprovacaoTrabalho' => [
                "type" => "date",
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
            "key" => ["idPosGraduacao"]
        ],
        
        "foreign" => [
            [
                "keys" => "numeroUSP",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ],
        ]
    ];
}