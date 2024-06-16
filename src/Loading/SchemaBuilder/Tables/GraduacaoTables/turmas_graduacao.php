<?php

return [

    "tableName" => "turmas_graduacao",

    "updateFunction" => 'GraduacaoOps/updateTurmasGraduacao',

    "columns" => [
        "id_turma" => [
            "type" => "char",
            "size" => 32
        ],
        "id_disciplina" => [
            "type" => "char",
            "size" => 8,
        ],
        "codigo_turma" => [
            "type" => "char",
            "size" => 7
        ],
        "tipo_turma" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "data_criacao_turma" => [
            "type" => "date",
            "nullable" => true
        ],
        "situacao_turma" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "data_inicio_turma" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_fim_turma" => [
            "type" => "date",
            "nullable" => true
        ],
        "carga_horaria_teorica" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "carga_horaria_pratica" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "numero_alunos_inicial" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "trancamentos_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "numero_alunos_final" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "pendencia_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "recuperacao_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "aprovacao_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "reprov_nota_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "reprov_freq_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "reprov_ambos_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "frequencia_media" => [
            "type" => "float",
            "nullable" => true
        ],
        "nota_media" => [
            "type" => "float",
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_turma"]
    ],

    "foreign" => [
        [
            "keys" => "id_disciplina",
            "references" => "id_disciplina",
            "on" => "disciplinas_graduacao",
            "onDelete" => "cascade"
        ]
    ]
];
