<?php

return [

    "tableName" => "bolsas_diversas",

    "updateFunction" => 'ProgramasUSPOps/updateBolsasDiversas',

    "columns" => [
        "id_bolsa_diversa" => [
            "type" => "char",
            "size" => 32
        ],
        "codigo_programa_usp" => [
            "type" => "smallInteger"
        ],
        "nome_programa_usp" => [
            "type" => "string",
            "size" => 60
        ],
        "numero_usp" => [
            "type" => "integer",
            "nullable" => true
        ],
        "situacao_bolsa" => [
            "type" => "string",
            "size" => 12
        ],
        "data_inicio_bolsa" => [
            "type" => "date"
        ],
        "data_fim_bolsa" => [
            "type" => "date"
        ],
        "justificativa_cancelamento_bolsa" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
        "tipo_vinculo_bolsista" => [
            "type" => "string",
            "size" => 40,
            "nullable" => true
        ],
        "id_graduacao_bolsista" => [
            "type" => "char",
            "size" => 32,
            "nullable" => true
        ],
        "nivel_pg_bolsista" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "id_inscricao_projeto" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "valor_bolsa_especifico" => [
            "type" => "decimal",
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_bolsa_diversa"]
    ],
    
    "foreign" => [
        // ver
        // [
        //     "keys" => "id_inscricao_projeto",
        //     "references" => "id_inscricao_projeto",
        //     "on" => "inscricoes_projetos_diversos",
        //     "onDelete" => "cascade"
        // ]
    ]
];