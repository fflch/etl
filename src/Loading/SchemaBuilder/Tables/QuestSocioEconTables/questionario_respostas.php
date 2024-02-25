<?php

return [

    "tableName" => "questionario_respostas",

    "updateFunction" => 'QuestSocioEconOps/updateQuestionarioRespostas',

    "columns" => [
        "id_graduacao" => [
            "type" => "char",
            "size" => 32
        ],
        "id_questao" => [
            "type" => "string",
            "size" => 12
        ],
        "alternativa_escolhida" => [
            "type" => "tinyInteger"
        ]
    ],

    "primary" => [
        "key" => ["id_graduacao", "id_questao"]
    ],
    
    "foreign" => [
        [
            "keys" => ["id_questao", "alternativa_escolhida"],
            "references" => ["id_questao", "codigo_alternativa"],
            "on" => "questionario_questoes",
            "onDelete" => "cascade"
        ]
    ]
];