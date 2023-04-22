<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class ServidoresSchemas
{
    const vinculos_servidores = [

        "tableName" => "vinculos_servidores",

        "columns" => [
            "id_vinculo" => [
                "type" => "char",
                "size" => 32
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "vinculo" => [
                "type" => "string",
                "size" => 48
            ],
            "situacao_atual" => [
                "type" => "string",
                "size" => 24
            ],
            "data_inicio_vinculo" => [
                "type" => "date"
            ],
            "data_fim_vinculo" => [
                "type" => "date",
                "nullable" => true
            ],
            "cod_ultimo_setor" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_ultimo_setor" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "ambito_funcao" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "classe" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "referencia" => [
                "type" => "string",
                "size" => 12,
                "nullable" => true
            ],
            "tipo_jornada" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "tipo_ingresso" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "data_ultima_alteracao_funcional" => [
                "type" => "date",
                "nullable" => true
            ],
            "ultima_ocorrencia" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "data_inicio_ultima_ocorrencia" => [
                "type" => "date",
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["id_vinculo"]
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

    const designacoes_servidores = [

        "tableName" => "designacoes_servidores",

        "columns" => [
            "id_vinculo" => [
                "type" => "char",
                "size" => 32
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "vinculo" => [
                "type" => "string",
                "size" => 48
            ],
            "data_inicio_designacao" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_fim_designacao" => [
                "type" => "date",
                "nullable" => true
            ],
            "codigo_setor_designacao" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_setor_designacao" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "nome_funcao" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "tipo_designacao" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            [
                "keys" => "id_vinculo",
                "references" => "id_vinculo",
                "on" => "vinculos_servidores",
                "onDelete" => "cascade"
            ],
        ]
    ];
}