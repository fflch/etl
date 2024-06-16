<?php

return [

    "tableName" => "turmas_posgraduacao",

    "updateFunction" => 'PosGraduacaoOps/updateTurmasPG',

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
            "type" => "smallInteger"
        ],
        "situacao_turma" => [
            "type" => "string",
            "size" => 16
        ],
        "data_inicio_turma" => [
            "type" => "date"
        ],
        "data_fim_turma" => [
            "type" => "date"
        ],
        "vagas_regulares" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "vagas_especiais" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "vagas_total" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "num_inscritos" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "num_matriculas_deferidas" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "num_matriculas_indeferidas" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "num_matriculas_canceladas" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "consolidacao_turma" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "consolidacao_resultados" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "data_cancelamento" => [
            "type" => "date",
            "nullable" => true
        ],
        "motivo_cancelamento" => [
            "type" => "string",
            "size" => 96,
            "nullable" => true
        ],
        "frequencia_media" => [
            "type" => "float",
            "nullable" => true
        ],
        "aprovacao_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "reprovacao_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "pendencia_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "alunos_fflch_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "alunos_externos_pct" => [
            "type" => "float",
            "nullable" => true
        ],
        "codigo_area" => [
            "type" => "integer",
            "nullable" => true
        ],
        "codigo_convenio" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nivel_convenio" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "lingua_turma" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "formato_oferecimento" => [
            "type" => "string",
            "size" => 16,
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
            "on" => "disciplinas_posgraduacao",
            "onDelete" => "cascade"
        ]
    ]
];
