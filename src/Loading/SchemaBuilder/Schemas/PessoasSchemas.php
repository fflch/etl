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
            "data_falecimento" => [
                "type" => "date",
                "nullable" => true
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
            "orientacao_sexual" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "identidade_genero" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "situacao_vacinal_covid" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "cpf" => [
                "type" => "char",
                "size" => 11,
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

    const titulos_pessoas = [

        "tableName" => "titulos_pessoas",

        "columns" => [
            "numero_usp" => [
                "type" => "integer"
            ],
            "nivel_titulo" => [
                "type" => "string",
                "size" => 24
            ],
            "ano_obtencao_titulo" => [
                "type" => "integer",
                "nullable" => true
            ],
            "descricao_titulo" => [
                "type" => "string",
                "size" => 256,
                "nullable" => true
            ],
            "codigo_instituicao" => [
                "type" => "integer",
                "nullable" => true
            ],
            "sigla_instituicao" => [
                "type" => "string",
                "size" => 24,
                "nullable" => true
            ],
            "nome_instituicao" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "codigo_curso_grad" => [
                "type" => "integer",
                "nullable" => true
            ],
            "codigo_habilitacao_grad" => [
                "type" => "integer",
                "nullable" => true
            ],
            "codigo_programa_posgrad" => [
                "type" => "integer",
                "nullable" => true
            ],
            "codigo_area_posgrad" => [
                "type" => "integer",
                "nullable" => true
            ],
            "ultimo_maior_titulo" => [
                "type" => "char",
                "size" => 1,
                "nullable" => true
            ],
        ],

        "primary" => [
            //
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