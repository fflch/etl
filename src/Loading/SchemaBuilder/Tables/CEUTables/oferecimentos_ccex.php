<?php

return [

    "tableName" => "oferecimentos_ccex",

    "updateFunction" => 'CEUOps/updateOferecimentosCCEx',

    "columns" => [
        "codigo_oferecimento" => [
            "type" => "char",
            "size" => 32
        ],
        "codigo_curso_ceu" => [
            "type" => "integer"
        ],
        "situacao_oferecimento" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "data_inicio_oferecimento" => [
            "type" => "date"
        ],
        "data_fim_oferecimento" => [
            "type" => "date"
        ],
        "total_carga_horaria" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "qntd_vagas_ofertadas" => [
            "type" => "smallInteger"
        ],
        "curso_pago" => [
            "type" => "char",
            "size" => 1
        ],
        "valor_inscricao_edicao" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "qntd_vagas_gratuitas" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "valor_previsto_arrecadacao" => [
            "type" => "integer",
            "nullable" => true
        ],
        "valor_previsto_custos" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "valor_previsto_prce" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "curso_para_empresas" => [
            "type" => "char",
            "size" => 1
        ],
        "local_curso" => [
            "type" => "string",
            "size" => 256
        ],
        "data_inicio_inscricoes" => [
            "type" => "date"
        ],
        "data_fim_inscricoes" => [
            "type" => "date"
        ],
        "permite_inscricao_online" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["codigo_oferecimento"]
    ],
    
    "foreign" => [
        [
            "keys" => "codigo_curso_ceu",
            "references" => "codigo_curso_ceu",
            "on" => "cursos_culturaextensao",
            "onDelete" => "cascade"
        ]
    ]
];