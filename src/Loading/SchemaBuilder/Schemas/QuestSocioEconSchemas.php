<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class QuestSocioEconSchemas
{
    const questionario_questoes = [

        "tableName" => "questionario_questoes",

        "columns" => [
            "id_questao" => [
                "type" => "string",
                "size" => 12
            ],
            "descricao_questao" => [
                "type" => "string",
                "size" => 512
            ],
            "codigo_alternativa" => [
                "type" => "tinyInteger"
            ],
            "descricao_alternativa" => [
                "type" => "string",
                "size" => 1024,
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["id_questao", "codigo_alternativa"]
        ],

        "foreign" => [
            //
        ]
    ];

    const questionario_respostas = [

        "tableName" => "questionario_respostas",

        "columns" => [
            "id_graduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "id_questao" => [
                "type" => "string",
                "size" => 12
            ],
            "alternativa_escolhida" => [
                "type" => "tinyInteger"
            ],
        ],

        "primary" => [
            "key" => ["id_graduacao", "id_questao"]
        ],

        "foreign" => [
            [
                "keys" => "id_graduacao",
                "references" => "id_graduacao",
                "on" => "graduacoes",
                "onDelete" => "cascade"
            ],
            [
                "keys" => ["id_questao", "alternativa_escolhida"],
                "references" => ["id_questao", "codigo_alternativa"],
                "on" => "questionario_questoes",
                "onDelete" => "cascade"
            ]
        ]
    ];
}