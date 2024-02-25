<?php

return [

    "tableName" => "projetos_diversos",

    "updateFunction" => 'ProgramasUSPOps/updateProjetosDiversos',

    "columns" => [
        "id_projeto_diverso" => [
            "type" => "string",
            "size" => 12
        ],
        "codigo_programa_usp" => [
             "type" => "smallInteger"
        ],
        "nome_programa_usp" => [
            "type" => "string",
            "size" => 60
        ],
        "juno_projeto_programa_usp" => [
            "type" => "string",
            "size" => 12
        ],
        "codigo_colegiado" => [
            "type" => "smallInteger"
        ],
        "sigla_colegiado" => [
            "type" => "char",
            "size" => 12
        ],
        "situacao_projeto" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "data_inicio_previsto" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_fim_previsto" => [
            "type" => "date",
            "nullable" => true
        ],
        "numero_usp_coordenador" => [
            "type" => "integer"
        ],
        "numero_bolsas_solicitadas" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "numero_bolsas_aprovadas" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "numero_participantes_nao_bolsistas" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "titulo_projeto" => [
            "type" => "string",
            "size" => 256
        ],
        "prefixo_disciplina" => [
            "type" => "char",
            "size" => 3,
            "nullable" => true
        ],
        "codigo_disciplina" => [
            "type" => "char",
            "size" => 7,
            "nullable" => true
        ],
        "valor_total_projeto" => [
            "type" => "decimal",
            "nullable" => true
        ],
        "vertente_pub" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "caracteristica_projeto" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_projeto_diverso"]
    ],
    
    "foreign" => [
        //
    ]
];