<?php

return [

    "tableName" => "disciplinas_posgraduacao",

    "updateFunction" => 'PosGraduacaoOps/updateDisciplinasPG',

    "columns" => [
        "id_disciplina" => [
            "type" => "char",
            "size" => 8
        ],
        "codigo_disciplina" => [
            "type" => "char",
            "size" => 7
        ],
        "versao_disciplina" => [
            "type" => "smallInteger"
        ],
        "departamento" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ],
        "nome_disciplina" => [
            "type" => "string",
            "size" => 256
        ],
        "tipo_curso" => [
            "type" => "string",
            "size" => 32
        ],
        "situacao_disciplina" => [
            "type" => "string",
            "size" => 16
        ],
        "data_proposicao_disciplina" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_ativacao_disciplina" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_desativacao_disciplina" => [
            "type" => "date",
            "nullable" => true
        ],
        "codigo_area" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_area" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "codigo_programa" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_programa" => [
            "type" => "string",
            "size" => 128,
            "nullable" => true
        ],
        "duracao_disciplina_semanas" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "carga_horaria_teorica" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "carga_horaria_pratica" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "carga_horaria_estudo" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "carga_horaria_total" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "total_creditos" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "formato_disciplina" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_disciplina"],
    ],

    "foreign" => [
        //
    ]
];
