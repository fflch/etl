<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class PosGraduacaoSchemas
{
    const posgraduacoes = [

        "tableName" => "posgraduacoes",

        "columns" => [
            "id_posgraduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "seq_programa" => [
                "type" => "tinyInteger"
            ],
            "tipo_matricula" => [
                "type" => "string",
                "size" => 24
            ],
            "nivel_programa" => [
                "type" => "string",
                "size" => 16,
            ],
            "codigo_area" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_area" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "codigo_programa" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_programa" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "data_selecao" => [
                "type" => "date"
            ],
            "primeira_matricula" => [
                "type" => "date",
                "nullable" => true
            ],
            "tipo_ultima_ocorrencia" => [
                "type" => "string",
                "size" => 48,
                "nullable" => true
            ],
            "data_ultima_ocorrencia" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_deposito_trabalho" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_aprovacao_trabalho" => [
                "type" => "date",
                "nullable" => true
            ]
        ],

        "primary" => [
            "key" => ["id_posgraduacao"]
        ],
        
        "foreign" => [
            [
                "keys" => "numero_usp",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const defesas_posgraduacao = [

        "tableName" => "defesas_posgraduacao",

        "columns" => [
            "id_defesa" => [
                "type" => "char",
                "size" => 32
            ],
            "id_posgraduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "data_defesa" => [
                "type" => "date"
            ],
            "local_defesa" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            // "resultado_defesa" => [
            //     "type" => "string",
            //     "size" => 32
            // ], // ver como extrair info
            "mencao_honrosa" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "titulo_trabalho" => [
                "type" => "string",
                "size" => 512,
                "nullable" => true // ver trabalho com titulo = null
            ],
        ],

        "primary" => [
            "key" => ["id_defesa"]
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

    const bancas_posgraduacao = [

        "tableName" => "bancas_posgraduacao",

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
            "tipoAvaliacao" => [
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
            [
                "keys" => "numero_usp_membro",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const orientacoes_posgraduacao = [

        "tableName" => "orientacoes_posgraduacao",

        "columns" => [
            "id_posgraduacao" => [
                "type" => "char",
                "size" => "32"
            ],
            "numero_usp_orientador" => [
                "type" => "integer"
            ],
            "sequencia_orientacao" => [
                "type" => "tinyInteger"
            ],
            "tipo_orientacao" => [
                "type" => "string",
                "size" => "32"
            ],
            "data_inicio_orientacao" => [
                "type" => "date"
            ],
            "data_fim_orientacao" => [
                "type" => "date",
                "nullable" => true
            ],
            "ultimo_orientador" => [
                "type" => "char",
                "size" => "1"
            ],
            "orientacao_especifica" => [
                "type" => "char",
                "size" => "1",
                "nullable" => true
            ],
            "data_conversao_para_plena" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_conversao_para_especifica" => [
                "type" => "date",
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
            [
                "keys" => "numero_usp_orientador",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const disciplinas_posgraduacao = [

        "tableName" => "disciplinas_posgraduacao",

        "columns" => [
            "codigo_disciplina" => [
                "type" => "char",
                "size" => 7
            ],
            "versao_disciplina" => [
                "type" => "smallInteger"
            ],
            "departamento" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "nome_disciplina" => [
                "type" => "string",
                "size" => 256
            ],
            "tipo_curso" => [
                "type" => "string",
                "size" => 32
            ],
            "status_disciplina" => [
                "type" => "string",
                "size" => 16
            ],
            "data_proposicao_disciplina" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_ativacao_disciplina" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_desativacao_disciplina" => [
                "type" => "date",
                "nullable" => true
            ],
            "codigo_area" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_area" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "codigo_programa" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_programa" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "duracao_disciplina_semanas" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "carga_horaria_teorica" => [
                "type" => "tinyInteger",
                "nullable" => true
            ],
            "carga_horaria_pratica" => [
                "type" => "tinyInteger",
                "nullable" => true
            ],
            "carga_horaria_estudo" => [
                "type" => "tinyInteger",
                "nullable" => true
            ],
            "carga_horaria_total" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "total_creditos" => [
                "type" => "tinyInteger",
                "nullable" => true
            ],
            "formato_disciplina" => [
                "type" => "string",
                "size" => 16,
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["codigo_disciplina", "versao_disciplina"],
            "keyName" => "disciplinas_posgraduacao_primary"
        ],
        
        "foreign" => [
            //
        ]
    ];

    const turmas_posgraduacao = [

        "tableName" => "turmas_posgraduacao",

        "columns" => [
            "id_turma" => [
                "type" => "char",
                "size" => 32
            ],
            "codigo_disciplina" => [
                "type" => "char",
                "size" => 7
            ],
            "versao_disciplina" => [
                "type" => "smallInteger"
            ],
            "codigo_turma" => [
                "type" => "smallInteger"
            ],
            "status_turma" => [
                "type" => "string",
                "size" => 16
            ],
            "data_inicio_turma" => [
                "type" => "date"
            ],
            "data_fim_turma" => [
                "type" => "date"
            ],
            "vagas_regulares" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "vagas_especiais" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "vagas_total" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "num_inscritos" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "num_matriculas_deferidas" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "num_matriculas_indeferidas" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "num_matriculas_canceladas" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "consolidacao_turma" => [
                "type" => "char",
                "size" => 1,
                "nullable" => true
            ],
            "consolidacao_resultados" => [
                "type" => "char",
                "size" => 1,
                "nullable" => true
            ],
            "data_cancelamento" => [
                "type" => "date",
                "nullable" => true
            ],
            "motivo_cancelamento" => [
                "type" => "string",
                "size" => 96,
                "nullable" => true
            ],
            "frequencia_media" => [
                "type" => "float",
                "nullable" => true
            ],
            "aprovacao_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "reprovacao_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "pendencia_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "alunos_fflch_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "alunos_externos_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "codigo_area" => [
                "type" => "integer",
                "nullable" => true
            ],
            "codigo_convenio" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nivel_convenio" => [
                "type" => "string",
                "size" => 16,
                "nullable" => true
            ],
            "lingua_turma" => [
                "type" => "string",
                "size" => 16,
                "nullable" => true
            ],
            "formato_oferecimento" => [
                "type" => "string",
                "size" => 16,
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["id_turma"]
        ],
        
        "foreign" => [
            [
                "keys" => ["codigo_disciplina", "versao_disciplina"],
                "references" => ["codigo_disciplina", "versao_disciplina"],
                "on" => "disciplinas_posgraduacao",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const ministrantes_posgraduacao = [

        "tableName" => "ministrantes_posgraduacao",

        "columns" => [
            "numero_usp" => [
                "type" => "integer"
            ],
            "id_turma" => [
                "type" => "char",
                "size" => 32
            ],
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            [
                "keys" => ["numero_usp"],
                "references" => ["numero_usp"],
                "on" => "pessoas",
                "onDelete" => "cascade"
            ],
            [
                "keys" => ["id_turma"],
                "references" => ["id_turma"],
                "on" => "turmas_posgraduacao",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const coordenadores_posgraduacao = [

        "tableName" => "coordenadores_posgraduacao",

        "columns" => [
            "numero_usp" => [
                "type" => "integer",
            ],
            "funcao" => [
                "type" => "string",
                "size" => 16
            ],
            "codigo_programa" => [
                "type" => "integer"
            ],
            "nome_programa" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "data_inicio_funcao" => [
                "type" => "date"
            ],
            "data_fim_funcao" => [
                "type" => "date",
                "nullable" => true
            ],
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            [
                "keys" => ["numero_usp"],
                "references" => ["numero_usp"],
                "on" => "pessoas",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const ocorrencias_posgraduacao = [

        "tableName" => "ocorrencias_posgraduacao",

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
            "motivo_desligamento" => [
                "type" => "string",
                "size" => 96,
                "nullable" => true
            ],
            "prazo_afastamento" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "motivo_trancamento" => [
                "type" => "string",
                "size" => 96,
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
            "prorrogacao_solicitada_dias" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "prorrogacao_obtida_dias" => [
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

    const bolsas_posgraduacao = [

        "tableName" => "bolsas_posgraduacao",

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

    const credenciamentos_pg = [

        "tableName" => "credenciamentos_pg",

        "columns" => [
            "id_credenciamento" => [
                "type" => "char",
                "size" => 32
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "codigo_area" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_area" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "codigo_programa" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_programa" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "nivel_credenciamento" => [
                "type" => "string",
                "size" => 16
            ],
            "tipo_credenciamento" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "situacao_credenciamento" => [
                "type" => "string",
                "size" => 12,
                "nullable" => true
            ],
            "data_inicio_validade" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_fim_validade" => [
                "type" => "date",
                "nullable" => true
            ],
            "ultimo_credenciamento_area" => [
                "type" => "char",
                "size" => 1
            ],
        ],

        "primary" => [
            "key" => ["id_credenciamento"]
        ],

        "foreign" => [
            [
                "keys" => "numero_usp",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ],
        ]
    ];
}