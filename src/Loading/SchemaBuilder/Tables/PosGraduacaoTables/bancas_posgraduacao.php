<?php

return [

    "tableName" => "bancas_posgraduacao",

    "updateFunction" => 'PosGraduacaoOps/updateBancasPG',

    "columns" => [
        "id_participacao_banca" => [
            "type" => "char",
            "size" => 32
        ],
        "id_defesa" => [
            "type" => "char",
            "size" => 32
        ],
        "numero_usp_membro" => [
            "type" => "integer"
        ],
        "vinculo_participacao" => [
            "type" => "string",
            "size" => 16
        ],
        "participacao_assinalada" => [ // ver utilidade
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "tipo_avaliacao" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "nota_defesa" => [
            "type" => "float",
            "nullable" => true
        ],
        "avaliacao_defesa" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "especialista" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "avaliacao_escrita" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "voto_dupla_titulacao" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_participacao_banca"]
    ],

    "foreign" => [
        [
            "keys" => "id_defesa",
            "references" => "id_defesa",
            "on" => "defesas_posgraduacao",
            "onDelete" => "cascade"
        ],
    ]
];
