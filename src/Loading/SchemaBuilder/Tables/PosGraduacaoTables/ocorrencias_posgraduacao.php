<?php

return [

    "tableName" => "ocorrencias_posgraduacao",

    "updateFunction" => 'PosGraduacaoOps/updateOcorrenciasPG',

    "columns" => [
        "id_posgraduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "data_ocorrencia" => [
            "type" => "date"
        ],
        "tipo_ocorrencia" => [
            "type" => "string",
            "size" => 96
        ],
        "motivo_ocorrencia" => [
            "type" => "string",
            "size" => 96,
            "nullable" => true
        ],
        "prazo_afastamento" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "codigo_area_destino" => [
            "type" => "integer",
            "nullable" => true
        ],
        "nome_area_destino" => [
            "type" => "string",
            "size" => 96,
            "nullable" => true
        ],
        "nivel_programa_destino" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "prorrogacao_def_solicitada_dias" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "prorrogacao_def_obtida_dias" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
    ],

    "primary" => [
        //
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