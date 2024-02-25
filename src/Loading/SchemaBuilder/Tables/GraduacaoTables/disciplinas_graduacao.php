<?php

return [

    "tableName" => "disciplinas_graduacao",

    "updateFunction" => 'GraduacaoOps/updateDisciplinasGraduacao',

    "columns" => [
        "codigo_disciplina" => [
            "type" => "char",
            "size" => 7
        ],
        "versao_disciplina" => [
            "type" => "tinyInteger"
        ],
        "nome_disciplina" => [
            "type" => "string",
            "size" => 256
        ],
        "situacao_disciplina" => [
            "type" => "string",
            "size" => 32,
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
        "credito_aula" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "credito_trabalho" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "duracao_disciplina_semanas" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "periodicidade_disciplina" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "carga_horaria_estagio" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "carga_horaria_licenciatura" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "carga_horaria_aacc" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["codigo_disciplina", "versao_disciplina"],
        "keyName" => "disciplinas_graduacao_primary"
    ],
    
    "foreign" => [
        //
    ]
];