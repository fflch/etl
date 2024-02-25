<?php

return [

    "tableName" => "questionario_questoes",

    "updateFunction" => 'QuestSocioEconOps/updateQuestionarioQuestoes',

    "columns" => [
        "id_questao" => [
            "type" => "string",
            "size" => 12
        ],
        "descricao_questao" => [
            "type" => "string",
            "size" => 512
        ],
        "codigo_alternativa" => [
            "type" => "tinyInteger"
        ],
        "descricao_alternativa" => [
            "type" => "string",
            "size" => 1024,
            "nullable" => true
        ]
    ],

    "primary" => [
        "key" => ["id_questao", "codigo_alternativa"]
    ],
    
    "foreign" => [
        //
    ]
];