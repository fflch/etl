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
            "tipo_vinculo" => [
                "type" => "string",
                "size" => 16
            ],
            "nivel_programa" => [
                "type" => "char",
                "size" => 2
            ],
            "codigo_area" => [
                "type" => "integer"
            ],
            "nome_area" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "codigo_programa" => [
                "type" => "integer"
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
                "type" => "date",
                "nullable" => true // ver
            ],
            "local_defesa" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "mencao_honrosa" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "titulo_trabalho" => [
                "type" => "string",
                "size" => 512,
                "nullable" => true // ver
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
            "participacao_assinalada" => [ // ver
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
}