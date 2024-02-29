<?php

return [

    "tableName" => "bolsas_posgraduacao",

    "updateFunction" => 'PosGraduacaoOps/updateBolsasPG',

    "columns" => [
        "id_bolsa" => [
            "type" => "char",
            "size" => 12
        ],
        "id_posgraduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "situacao_bolsa" => [
            "type" => "string",
            "size" => 16
        ],
        "data_inicio_bolsa" => [
            "type" => "date"
        ],
        "data_fim_bolsa" => [
            "type" => "date"
        ],
        "codigo_instituicao_fomento" => [
            "type" => "integer"
        ],
        "sigla_instituicao_fomento" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ],
        "nome_instituicao_fomento" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
        "codigo_programa_fomento" => [
            "type" => "integer"
        ],
        "nome_programa_fomento" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_bolsa"]
    ],

    "foreign" => [
        [
            "keys" => "id_posgraduacao",
            "references" => "id_posgraduacao",
            "on" => "posgraduacoes",
            "onDelete" => "cascade"
        ],
    ]
];