<?php

return [

    "tableName" => "demanda_turmas_graduacao",

    "updateFunction" => 'GraduacaoOps/updateDemandaTurmasGraduacao',

    "columns" => [
        "id_turma" => [
            "type" => "char",
            "size" => 32
        ],
        "vagas_total" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "inscritos_total" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "matriculados_total" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "vagas_tipo_obrigatoria" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "inscritos_tipo_obrigatoria" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "matriculados_tipo_obrigatoria" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "vagas_tipo_opt_eletiva" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "inscritos_tipo_opt_eletiva" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "matriculados_tipo_opt_eletiva" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "vagas_tipo_opt_livre" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "inscritos_tipo_opt_livre" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "matriculados_tipo_opt_livre" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "vagas_tipo_extracurricular" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "inscritos_tipo_extracurricular" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "matriculados_tipo_extracurricular" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "vagas_tipo_especial" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "inscritos_tipo_especial" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "matriculados_tipo_especial" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_turma"]
    ],
    
    "foreign" => [
        [
            "keys" => "id_turma",
            "references" => "id_turma",
            "on" => "turmas_graduacao",
            "onDelete" => "cascade"
        ]
    ]
];