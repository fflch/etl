<?php

return [

    "tableName" => "inscricoes_projetos_diversos",

    "updateFunction" => 'ProgramasUSPOps/updateInscricoesProjetosDiversos',

    "columns" => [
        "id_inscricao_projeto" => [
            "type" => "char",
            "size" => 32
        ],
        "id_projeto_diverso" => [
            "type" => "char",
            "size" => 12
        ],
        "numero_usp" => [
            "type" => "integer"
        ],
        "tipo_vinculo_inscrito" => [
            "type" => "string",
            "size" => 40,
            "nullable" => true
        ],
        "data_inscricao_projeto" => [
            "type" => "date"
        ],
        "inscricao_selecionada" => [
            "type" => "char",
            "size" => 1
        ],
        "data_selecao_rejeicao" => [
            "type" => "date",
            "nullable" => true
        ],
        "selecionado_docente_outro_projeto" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "comparecimento_entrevista" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "cursou_disciplina" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "status_aceite_aluno" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "data_aceite_aluno" => [
            "type" => "date",
            "nullable" => true
        ],
        "status_aceite_docente" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "data_aceite_docente" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_solicitacao_desligamento" => [
            "type" => "date",
            "nullable" => true
        ],
        "codigo_motivo_solicitacao_desligamento" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "motivo_desligamento" => [
            "type" => "string",
            "size" => 64,
            "nullable" => true
        ],
        "motivo_desligamento_solicitacao_outro" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
        "status_resultado_solicitacao_desligamento" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "data_resultado_solicitacao_desligamento" => [
            "type" => "date",
            "nullable" => true
        ],
        "data_envio_relatorio_final" => [
            "type" => "date",
            "nullable" => true
        ],
        "solicitou_substituicao" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "numero_usp_substituto" => [
            "type" => "integer",
            "nullable" => true
        ],
        "bolsista_ou_voluntario" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_inscricao_projeto"]
    ],
    
    "foreign" => [
        // ver
        // [
        //     "keys" => "id_projeto_diverso",
        //     "references" => "id_projeto_diverso",
        //     "on" => "projetos_diversos",
        //     "onDelete" => "cascade"
        // ]
    ]
];