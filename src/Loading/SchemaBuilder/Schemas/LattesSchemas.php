<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class LattesSchemas
{
    const lattes = [

        "tableName" => "lattes",

        "columns" => [
            "numero_cnpq" => [
                "type" => "bigInteger"
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "data_atualizacao_cv" => [
                "type" => "date"
            ],
            "data_extracao_cv" => [
                "type" => "date",
                "nullable" => true
            ],
            "lattes" => [
                "type" => "json",
                "nullable" => true
            ],
            null => [
                "type" => "timestamps"
            ],
        ],

        "primary" => [
            "key" => ["numero_cnpq"]
        ],
        
        "foreign" => [
            // [
            //     "keys" => "numero_usp",
            //     "references" => "numero_usp",
            //     "on" => "pessoas",
            //     "onDelete" => "cascade"
            // ],
        ]
    ];
}