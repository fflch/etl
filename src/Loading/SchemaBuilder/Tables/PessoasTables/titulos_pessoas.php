<?php

return [

    "tableName" => "titulos_pessoas",

    "updateFunction" => 'PessoasOps/updateTitulosPessoas',

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
        //
    ]
];