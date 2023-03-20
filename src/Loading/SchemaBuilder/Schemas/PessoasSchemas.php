<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class PessoasSchemas
{
    const pessoas = [

        "tableName" => "pessoas",

        "columns" => [
            "numero_usp" => [
                "type" => "integer"
            ],
            "nome" => [
                "type" => "string",
                "size" => 256
            ],
            "data_nascimento" => [
                "type" => "date"
            ],
            "email" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "nacionalidade" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "cidade_nascimento" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "estado_nascimento" => [
                "type" => "string",
                "size" => 2,
                "nullable" => true
            ],
            "pais_nascimento" => [
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
            "cpf" => [
                "type" => "bigInteger",
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["numero_usp"]
        ],
        
        "foreign" => [
            //
        ]
    ];
}