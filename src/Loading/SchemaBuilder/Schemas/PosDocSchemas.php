<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class PosDocSchemas
{
    const projetos_posdoc = [

        "tableName" => "projetos_posdoc",

        "columns" => [
            "idProjeto" => [
                "type" => "string",
                "size" => 12
            ],
            "programa" => [
                "type" => "char",
                "size" => 2
            ],
            "numeroUSP" => [
                "type" => "integer"
            ],
            "dataInicioProjeto" => [
                "type" => "date",
                "nullable" => true
            ],
            "dataFimProjeto" => [
                "type" => "date",
                "nullable" => true
            ],
            "situacaoProjeto" => [
                "type" => "string",
                "size" => 16
            ],
            "codigoDepartamento" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nomeDepartamento" => [
                "type" => "string",
                "size" => 256,
                "nullable" => true
            ],
            "tituloProjeto" => [
                "type" => "string",
                "size" => 1024
            ],
            "palavrasChave" => [
                "type" => "string",
                "size" => 256,
                "nullable" => true
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            "key" => ["idProjeto"]
        ],
        
        "foreign" => [
            [
                "keys" => "numeroUSP",
                "references" => "numero_usp",
                "on" => "pessoas",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const periodos_posdoc = [

        "tableName" => "periodos_posdoc",

        "columns" => [
            "idProjeto" => [
                "type" => "string",
                "size" => 12
            ],
            "sequenciaPeriodo" => [
                "type" => "smallInteger",
            ],
            "dataInicioPeriodo" => [
                "type" => "date"
            ],
            "dataFimPeriodo" => [
                "type" => "date",
                "nullable" => true
            ],
            "situacaoPeriodo" => [
                "type" => "string",
                "size" => 32
            ],
            "fonteRecurso" => [
                "type" => "string",
                "size" => 32
            ],
            "horasSemanais" => [
                "type" => "tinyInteger",
                "nullable" => true
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            "key" => ["idProjeto", "sequenciaPeriodo"]
        ],
        
        "foreign" => [
            [
                "keys" => "idProjeto",
                "references" => "idProjeto",
                "on" => "projetos_posdoc",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const bolsas_posdoc = [

        "tableName" => "bolsas_posdoc",

        "columns" => [
            "idProjeto" => [
                "type" => "string",
                "size" => 12
            ],
            "sequenciaPeriodo" => [
                "type" => "smallInteger",
            ],
            "sequenciaFomento" => [
                "type" => "tinyInteger"
            ],
            "codigoFomento" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "nomeFomento" => [
                "type" => "string",
                "size" => 256,
                "nullable" => true
            ],
            "dataInicioFomento" => [
                "type" => "date",
                "nullable" => true
            ],
            "dataFimFomento" => [
                "type" => "date",
                "nullable" => true
            ],
            "idFomento" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            "key" => ["idProjeto", "sequenciaPeriodo", "sequenciaFomento"],
            "keyName" => "bolsasposdoc_primary"
        ],
        
        "foreign" => [
            [
                "keys" => ["idProjeto", "sequenciaPeriodo"],
                "references" => ["idProjeto", "sequenciaPeriodo"],
                "on" => "periodos_posdoc",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const afastempresas_posdoc = [

        "tableName" => "afastempresas_posdoc",

        "columns" => [
            "idProjeto" => [
                "type" => "string",
                "size" => 12
            ],
            "sequenciaPeriodo" => [
                "type" => "smallInteger",
            ],
            "seqVinculoEmpresa" => [
                "type" => 'tinyInteger'
            ],
            "nomeEmpresa" => [
                "type" => "string",
                "size" => 512
            ],
            "dataInicioAfastamento" => [
                "type" => "date",
                "nullable" => true
            ],
            "dataFimAfastamento" => [
                "type" => "date",
                "nullable" => true
            ],
            "tipoVinculo" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            "key" => ["idProjeto", "sequenciaPeriodo", "seqVinculoEmpresa"],
            "keyName" => "afastamentos_empregaticios_primary"
        ],
        
        "foreign" => [
            [
                "keys" => ["idProjeto", "sequenciaPeriodo"],
                "references" => ["idProjeto", "sequenciaPeriodo"],
                "on" => "periodos_posdoc",
                "onDelete" => "cascade"
            ],
        ]
    ];

    const supervisoes_posdoc = [

        "tableName" => "supervisoes_posdoc",

        "columns" => [
            "idProjeto" => [
                "type" => "string",
                "size" => 12
            ],
            "sequenciaSupervisao" => [
                "type" => "smallInteger",
            ],
            "numeroUSPSupervisor" => [
                "type" => "integer"
            ],
            "nomeSupervisor" => [
                "type" => "string",
                "size" => 256
            ],
            "tipoSupervisao" => [
                "type" => "string",
                "size" => 40
            ],
            "dataInicioSupervisao" => [
                "type" => "date"
            ],
            "dataFimSupervisao" => [
                "type" => "date"
            ],
            "ultimoSupervisorResp" => [
                "type" => "char",
                "size" => 1
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            "key" => ["idProjeto", "sequenciaSupervisao", "tipoSupervisao"],
            "keyName" => "supervisoes_posdoc_primary"
        ],
        
        "foreign" => [
            [
                "keys" => "idProjeto",
                "references" => "idProjeto",
                "on" => "projetos_posdoc",
                "onDelete" => "cascade"
            ],
        ]
    ];
}