<?php

return [

    "tableName" => "cursos_culturaextensao",

    "updateFunction" => 'CEUOps/updateCursosCEU',

    "columns" => [
        "codigo_curso_ceu" => [
            "type" => "integer"
        ],
        "sigla_unidade" => [
            "type" => "string",
            "size" => 16
        ],
        "codigo_departamento" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_departamento" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ],
        "modalidade_curso" => [
            "type" => "string",
            "size" => 32
        ],
        "nome_curso" => [
            "type" => "string",
            "size" => 256
        ],
        "tipo" => [
            "type" => "string",
            "size" => 32
        ],
        "codigo_colegiado" => [
            "type" => "smallInteger"
        ],
        "sigla_colegiado" => [
            "type" => "string",
            "size" => 32
        ],
        "area_conhecimento" => [
            "type" => "string",
            "size" => 128
        ],
        "area_tematica" => [
            "type" => "string",
            "size" => 128
        ],
        "linha_extensao" => [
            "type" => "string",
            "size" => 256
        ],
    ],

    "primary" => [
        "key" => ["codigo_curso_ceu"]
    ],
    
    "foreign" => [
        //
    ]
];

