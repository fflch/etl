<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class GraduacaoSchemas
{
    const graduacoes = [

        "tableName" => "graduacoes",

        "columns" => [
            "id_graduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "sequencia_curso" => [
                "type" => "tinyInteger"
            ],
            "situacao_curso" => [
                "type" => "string",
                "size" => 16
            ],
            "data_inicio_vinculo" => [
                "type" => "date"
            ],
            "data_fim_vinculo" => [
                "type" => "date",
                "nullable" => true
            ],
            "codigo_curso" => [
                "type" => "integer"
            ],
            "nome_curso" => [
                "type" => "string",
                "size" => 32
            ],
            "tipo_ingresso" => [
                "type" => "string",
                "size" => 64
            ],
            "categoria_ingresso" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "rank_ingresso" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "tipo_encerramento_bacharel" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "data_encerramento_bacharel" => [
                "type" => "date",
                "nullable" => true
            ]
        ],

        "primary" => [
            "key" => ["id_graduacao"]
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

    const habilitacoes = [

        "tableName" => "habilitacoes",

        "columns" => [
            "id_graduacao" => [
                "type" => "char",
                "size" => 32
            ],
            "codigo_curso" => [
                "type" => "integer"
            ],
            "codigo_habilitacao" => [
                "type" => "integer"
            ],
            "nome_habilitacao" => [
                "type" => "string",
                "size" => 64
            ],
            "tipo_habilitacao" => [
                "type" => "string",
                "size" => 32
            ],
            "periodo_habilitacao" => [
                "type" => "string",
                "size" => 32
            ],
            "data_inicio_habilitacao" => [
                "type" => "date"
            ],
            "data_fim_habilitacao" => [
                "type" => "date",
                "nullable" => true
            ],
            "tipo_encerramento" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ]
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            [
                "keys" => "id_graduacao",
                "references" => "id_graduacao",
                "on" => "graduacoes",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const iniciacoes = [

        "tableName" => "iniciacoes",

        "columns" => [
            "id_projeto" => [
                "type" => "string",
                "size" => 12
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "data_inicio_projeto" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_fim_projeto" => [
                "type" => "date",
                "nullable" => true
            ],
            "situacao_projeto" => [
                "type" => "string",
                "size" => 32
            ],
            "ano_projeto" => [
                "type" => "smallInteger"
            ],
            "codigo_departamento" => [
                "type" => "integer"
            ],
            "nome_departamento" => [
                "type" => "string",
                "size" => 64
            ],
            "numero_usp_orientador" => [
                "type" => "integer",
                "nullable" => true
            ],
            "titulo_projeto" => [
                "type" => "string",
                "size" => 256
            ],
            "palavras_chave" => [
                "type" => "string",
                "size" => 128
            ]
        ],

        "primary" => [
            "key" => ["id_projeto"]
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

    const bolsasIC = [

        "tableName" => "bolsas_ic",

        "columns" => [
            "id_projeto" => [
                "type" => "string",
                "size" => 12
            ],
            "sequencia_fomento" => [
                "type" => "integer"
            ],
            "nome_fomento" => [
                "type" => "string",
                "size" => 128
            ],
            "fomento_edital" => [
                "type" => "integer",
                "nullable" => true
            ],
            "data_inicio_fomento" => [
                "type" => "Date",
                "nullable" => true
            ],
            "data_fim_fomento" => [
                "type" => "Date",
                "nullable" => true
            ]
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            [
                "keys" => "id_projeto",
                "references" => "id_projeto",
                "on" => "iniciacoes",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const questionario_questoes = [

        "tableName" => "questionario_questoes",

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

    const questionario_respostas = [

        "tableName" => "questionario_respostas",

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
            //
        ],
        
        "foreign" => [
            [
                "keys" => "id_graduacao",
                "references" => "id_graduacao",
                "on" => "graduacoes",
                "onDelete" => "cascade"
            ],
            [
                "keys" => ["id_questao", "alternativa_escolhida"],
                "references" => ["id_questao", "codigo_alternativa"],
                "on" => "questionario_questoes",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const siicusp_trabalhos = [

        "tableName" => "siicusp_trabalhos",

        "columns" => [
            "id_trabalho" => [
                "type" => "string",
                "size" => 12
            ],
            "titulo_trabalho" => [
                "type" => "string",
                "size" => 512
            ],
            "id_projeto_ic" => [
                "type" => "string",
                "size" => 12,
                "nullable" => true
            ],
            "edicao_siicusp" => [
                "type" => "smallInteger",
            ],
            "situacao_inscricao" => [
                "type" => "string",
                "size" => 24
            ],
            "situacao_apresentacao" => [
                "type" => "string",
                "size" => 24,
                "nullable" => true
            ],
            "prox_etapa_recomendado" => [
                "type" => "char",
                "size" => 1
            ],
            "prox_etapa_apresentado" => [
                "type" => "char",
                "size" => 1
            ],
            "mencao_honrosa" => [
                "type" => "char",
                "size" => 1
            ],
            "codigo_dpto_orientador" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_dpto_orientador" => [
                "type" => "string",
                "size" => 256,
                "nullable" => true
            ]
        ],

        "primary" => [
            "key" => ["id_trabalho"]
        ],
        
        "foreign" => [
            //
        ]
    ];

    const siicusp_participantes = [

        "tableName" => "siicusp_participantes",

        "columns" => [
            "id_trabalho" => [
                "type" => "string",
                "size" => 12
            ],
            "tipo_participante" => [
                "type" => "string",
                "size" => 32
            ],
            "numero_usp" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_participante" => [
                "type" => "string",
                "size" => 128,
                "nullable" => true
            ],
            "codigo_unidade" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "sigla_unidade" => [
                "type" => "string",
                "size" => 24,
                "nullable" => true
            ],
            "codigo_departamento" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_departamento" => [
                "type" => "string",
                "size" => 256,
                "nullable" => true
            ],
            "participante_apresentador" => [
                "type" => "char",
                "size" => 1
            ]
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            [
                "keys" => "id_trabalho",
                "references" => "id_trabalho",
                "on" => "siicusp_trabalhos",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const disciplinas_graduacao = [

        "tableName" => "disciplinas_graduacao",

        "columns" => [
            "codigo_disciplina" => [
                "type" => "char",
                "size" => 7
            ],
            "versao_disciplina" => [
                "type" => "tinyInteger"
            ],
            "nome_disciplina" => [
                "type" => "string",
                "size" => 256
            ],
            "situacao_disciplina" => [
                "type" => "string",
                "size" => 32,
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
            "credito_aula" => [
                "type" => "tinyInteger",
                "nullable" => true
            ],
            "credito_trabalho" => [
                "type" => "tinyInteger",
                "nullable" => true
            ],
            "duracao_disciplina_semanas" => [
                "type" => "tinyInteger",
                "nullable" => true
            ],
            "periodicidade_disciplina" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "carga_horaria_estagio" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "carga_horaria_licenciatura" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "carga_horaria_aacc" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["codigo_disciplina", "versao_disciplina"],
            "keyName" => "disciplinas_graduacao_primary"
        ],
        
        "foreign" => [
            //
        ]
    ];

    const turmas_graduacao = [

        "tableName" => "turmas_graduacao",

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
                "type" => "tinyInteger"
            ],
            "codigo_turma" => [
                "type" => "char",
                "size" => 7
            ],
            "tipo_turma" => [
                "type" => "string",
                "size" => 16,
                "nullable" => true
            ],
            "data_criacao_turma" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_inicio_aulas" => [
                "type" => "date",
                "nullable" => true
            ],
            "data_fim_aulas" => [
                "type" => "date",
                "nullable" => true
            ],
            "status_turma" => [
                "type" => "string",
                "size" => 16,
                "nullable" => true
            ],
            "carga_horaria_teorica" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "carga_horaria_pratica" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "numero_alunos_matriculados" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "trancamentos_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "result_pendente_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "frequencia_media" => [
                "type" => "float",
                "nullable" => true
            ],
            "nota_media" => [
                "type" => "float",
                "nullable" => true
            ],
            "recuperacao_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "aprovados_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "reprov_nota_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "reprov_freq_pct" => [
                "type" => "float",
                "nullable" => true
            ],
            "reprov_ambos_pct" => [
                "type" => "float",
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
                "on" => "disciplinas_graduacao",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const demanda_turmas_graduacao = [

        "tableName" => "demanda_turmas_graduacao",

        "columns" => [
            "id_turma" => [
                "type" => "char",
                "size" => 32
            ],
            "vagas_total" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "inscritos_total" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "matriculados_total" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "vagas_tipo_obrigatoria" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "inscritos_tipo_obrigatoria" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "matriculados_tipo_obrigatoria" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "vagas_tipo_opt_eletiva" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "inscritos_tipo_opt_eletiva" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "matriculados_tipo_opt_eletiva" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "vagas_tipo_opt_livre" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "inscritos_tipo_opt_livre" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "matriculados_tipo_opt_livre" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "vagas_tipo_extracurricular" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "inscritos_tipo_extracurricular" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "matriculados_tipo_extracurricular" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "vagas_tipo_especial" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "inscritos_tipo_especial" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "matriculados_tipo_especial" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["id_turma"]
        ],
        
        "foreign" => [
            [
                "keys" => "id_turma",
                "references" => "id_turma",
                "on" => "turmas_graduacao",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const ministrantes_graduacao = [

        "tableName" => "ministrantes_graduacao",

        "columns" => [
            "numero_usp" => [
                "type" => "integer"
            ],
            "id_turma" => [
                "type" => "char",
                "size" => 32
            ],
            "periodicidade_ministrante" => [
                "type" => "string",
                "size" => 24,
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["numero_usp", "id_turma"]
        ],
        
        "foreign" => [
            [
                "keys" => "numero_usp",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ],
            [
                "keys" => "id_turma",
                "references" => "id_turma",
                "on" => "turmas_graduacao",
                "onDelete" => "cascade"
            ]
        ]
    ];
}