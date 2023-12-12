<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class ProgramasUSPSchemas
{
    const auxilios_concedidos = [

        "tableName" => "auxilios_concedidos",

        "columns" => [
            "id_concessao_auxilio" => [
                "type" => "char",
                "size" => 32
            ],
            "codigo_auxilio" => [
                "type" => "smallInteger"
            ],
            "nome_auxilio" => [
                "type" => "string",
                "size" => 60
            ],
            "numero_usp" => [
                "type" => "integer",
                "nullable" => true
            ],
            "situacao_auxilio" => [
                "type" => "string",
                "size" => 12
            ],
            "data_inicio_auxilio" => [
                "type" => "date"
            ],
            "data_fim_auxilio" => [
                "type" => "date"
            ],
            "justificativa_cancelamento_auxilio" => [
                "type" => "string",
                "size" => 256,
                "nullable" => true
            ],
            "tipo_vinculo_beneficiario" => [
                "type" => "string",
                "size" => 40,
                "nullable" => true
            ],
            "id_graduacao_beneficiario" => [
                "type" => "char",
                "size" => 32,
                "nullable" => true
            ],
            "nivel_pg_beneficiario" => [
                "type" => "string",
                "size" => 16,
                "nullable" => true
            ],
            "cota_mensal_prevista" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "valor_auxilio_especifico" => [
                "type" => "decimal",
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["id_concessao_auxilio"]
        ],
        
        "foreign" => [
            [
                "keys" => "numero_usp",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const projetos_diversos = [

        "tableName" => "projetos_diversos",

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

    const inscricoes_projetos_diversos = [

        "tableName" => "inscricoes_projetos_diversos",

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

    const bolsas_diversas = [

        "tableName" => "bolsas_diversas",

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
            [
                "keys" => "numero_usp",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ]
            // ver
            // [
            //     "keys" => "id_inscricao_projeto",
            //     "references" => "id_inscricao_projeto",
            //     "on" => "inscricoes_projetos_diversos",
            //     "onDelete" => "cascade"
            // ]
        ]
    ];
}