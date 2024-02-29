<?php

return [

    "tableName" => "estagios_pae",

    "updateFunction" => 'PosGraduacaoOps/updateEstagiosPae',

    "columns" => [
        "id_pae" => [
            "type" => "char",
            "size" => 32
        ],
        "numero_usp" => [
            "type" => "integer"
        ],
        "nivel_programa" => [
            "type" => "string",
            "size" => 16,
        ],
        "modalidade_pae" => [
            "type" => "string",
            "size" => 16
        ],
        "data_inicio_pae" => [
            "type" => "date"
        ],
        "data_fim_pae" => [
            "type" => "date"
        ],
        "observacao" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
        "justificativa_cancelamento" => [
            "type" => "string",
            "size" => 256,
            "nullable" => true
        ],
        "inscrito" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "codigo_disciplina_estagio" => [
            "type" => "char",
            "size" => 7,
            "nullable" => true
        ],
        "versao_disciplina_estagio" => [
            "type" => "tinyInteger",
            "nullable" => true
        ],
        "situacao_estagio" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "unidade_estagio" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "numero_usp_supervisor" => [
            "type" => "integer",
            "nullable" => true
        ],
        "periodo_epp" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "situacao_epp" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "modalidade_epp" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "codigo_disciplina_epp" => [
            "type" => "char",
            "size" => 7,
            "nullable" => true
        ],
        "unidade_epp" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "situacao_inscricao" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "classificacao_bolsa" => [
            "type" => "smallInteger",
            "nullable" => true
        ],
        "bolsista_ou_voluntario" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "unidade_inscricao" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "observacao2" => [
            "type" => "string",
            "size" => 100,
            "nullable" => true
        ],
        "organizacao_disciplina_externa" => [
            "type" => "string",
            "size" => 100,
            "nullable" => true
        ],
        "unidade_cota_interunidades" => [
            "type" => "string",
            "size" => 16,
            "nullable" => true
        ],
        "validacao_inscricao_orientador" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "validacao_inscricao_supervisor" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
        "validacao_inscricao_unidade" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "validacao_inscricao_pro_reitoria" => [
            "type" => "char",
            "size" => 1,
            "nullable" => true
        ],
        "vinculo_empregaticio" => [
            "type" => "string",
            "size" => 32,
            "nullable" => true
        ],
    ],

    "primary" => [
        "key" => ["id_pae"]
    ],

    "foreign" => [
        //
    ]
];