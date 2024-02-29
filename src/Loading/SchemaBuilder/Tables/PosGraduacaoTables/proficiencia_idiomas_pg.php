<?php

return [

    "tableName" => "proficiencia_idiomas_pg",

    "updateFunction" => 'PosGraduacaoOps/updateProficienciaIdiomasPG',

    "columns" => [
        "id_posgraduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "idioma" => [
            "type" => "string",
            "size" => 40
        ],
        "data_exame" => [
            "type" => "date",
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