<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class CEUSchemas
{
    const cursos_culturaextensao = [

        "tableName" => "cursos_culturaextensao",

        "columns" => [
            "codigo_curso_ceu" => [
                "type" => "integer"
            ],
            "sigla_unidade" => [
                "type" => "string",
                "size" => 16
            ],
            "codigo_departamento" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nome_departamento" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "modalidade_curso" => [
                "type" => "string",
                "size" => 32
            ],
            "nome_curso" => [
                "type" => "string",
                "size" => 256
            ],
            "tipo" => [
                "type" => "string",
                "size" => 32
            ],
            "codigo_colegiado" => [
                "type" => "smallInteger"
            ],
            "sigla_colegiado" => [
                "type" => "string",
                "size" => 32
            ],
            "area_conhecimento" => [
                "type" => "string",
                "size" => 128
            ],
            "area_tematica" => [
                "type" => "string",
                "size" => 128
            ],
            "linha_extensao" => [
                "type" => "string",
                "size" => 256
            ],
        ],

        "primary" => [
            "key" => ["codigo_curso_ceu"]
        ],
        
        "foreign" => [
            //
        ]
    ];

    const oferecimentos_ccex = [

        "tableName" => "oferecimentos_ccex",

        "columns" => [
            "codigo_oferecimento" => [
                "type" => "char",
                "size" => 32
            ],
            "codigo_curso_ceu" => [
                "type" => "integer"
            ],
            "situacao_oferecimento" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "data_inicio_oferecimento" => [
                "type" => "date"
            ],
            "data_fim_oferecimento" => [
                "type" => "date"
            ],
            "total_carga_horaria" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "qntd_vagas_ofertadas" => [
                "type" => "smallInteger"
            ],
            "curso_pago" => [
                "type" => "char",
                "size" => 1
            ],
            "valor_inscricao_edicao" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "qntd_vagas_gratuitas" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "valor_previsto_arrecadacao" => [
                "type" => "integer",
                "nullable" => true
            ],
            "valor_previsto_custos" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "valor_previsto_prce" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "curso_para_empresas" => [
                "type" => "char",
                "size" => 1
            ],
            "local_curso" => [
                "type" => "string",
                "size" => 256
            ],
            "data_inicio_inscricoes" => [
                "type" => "date"
            ],
            "data_fim_inscricoes" => [
                "type" => "date"
            ],
            "permite_inscricao_online" => [
                "type" => "char",
                "size" => 1,
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["codigo_oferecimento"]
        ],
        
        "foreign" => [
            [
                "keys" => "codigo_curso_ceu",
                "references" => "codigo_curso_ceu",
                "on" => "cursos_culturaextensao",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const inscricoes_ccex = [

        "tableName" => "inscricoes_ccex",

        "columns" => [
            "codigo_oferecimento" => [
                "type" => "char",
                "size" => 32
            ],
            "numero_ceu" => [
                "type" => "integer",
                "nullable" => true
            ],
            "data_inscricao" => [
                "type" => "dateTime",
                "nullable" => true
            ],
            "situacao_inscricao" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true //corrigir
            ],
            "origem_inscricao" => [
                "type" => "string",
                "size" => 16,
                "nullable" => true
            ],
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            [
                "keys" => "codigo_oferecimento",
                "references" => "codigo_oferecimento",
                "on" => "oferecimentos_ccex",
                "onDelete" => "cascade"
            ]
        ]
    ];

    const matriculas_ccex = [

        "tableName" => "matriculas_ccex",

        "columns" => [
            "codigo_matricula_ceu" => [
                "type" => "integer"
            ],
            "numero_usp" => [
                "type" => "integer"
            ],
            "codigo_oferecimento" => [
                "type" => "char",
                "size" => 32
            ],
            "data_matricula" => [
                "type" => "dateTime"
            ],
            "status_matricula" => [
                "type" => "string",
                "size" => 16
            ],
            "data_inicio_curso" => [
                "type" => "date"
            ],
            "data_fim_curso" => [
                "type" => "date"
            ],
            "frequencia_aluno" => [
                "type" => "tinyInteger",
                "nullable" => true
            ],
            "conceito_final_aluno" => [
                "type" => "string",
                "size" => 16,
                "nullable" => true
            ],
        ],

        "primary" => [
            "key" => ["codigo_matricula_ceu"]
        ],
        
        "foreign" => [
            [
                "keys" => "numero_usp",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ],
            [
                "keys" => "codigo_oferecimento",
                "references" => "codigo_oferecimento",
                "on" => "oferecimentos_ccex",
                "onDelete" => "cascade"
            ]
        ]
    ];
}