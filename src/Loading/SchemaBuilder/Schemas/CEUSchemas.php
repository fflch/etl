<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class CEUSchemas
{
    const cursos_culturaextensao = [

        "tableName" => "cursos_culturaextensao",

        "columns" => [
            "codigoCursoCEU" => [
                "type" => "integer"
            ],
            "siglaUnidade" => [
                "type" => "string",
                "size" => 16
            ],
            "codigoDepartamento" => [
                "type" => "integer",
                "nullable" => true
            ],
            "nomeDepartamento" => [
                "type" => "string",
                "size" => 64,
                "nullable" => true
            ],
            "modalidadeCurso" => [
                "type" => "string",
                "size" => 32
            ],
            "nomeCurso" => [
                "type" => "string",
                "size" => 256
            ],
            "tipo" => [
                "type" => "string",
                "size" => 32
            ],
            "codigoColegiado" => [
                "type" => "smallInteger"
            ],
            "siglaColegiado" => [
                "type" => "string",
                "size" => 32
            ],
            "areaConhecimento" => [
                "type" => "string",
                "size" => 128
            ],
            "areaTematica" => [
                "type" => "string",
                "size" => 128
            ],
            "linhaExtensao" => [
                "type" => "string",
                "size" => 256
            ],
            "created_at" => [
                "type" => "timestamp"
            ],
            "updated_at" => [
                "type" => "timestamp"
            ],
        ],

        "primary" => [
            "key" => ["codigoCursoCEU"]
        ],
        
        "foreign" => [
            //
        ]
    ];

    const oferecimentos_ccex = [

        "tableName" => "oferecimentos_ccex",

        "columns" => [
            "codigoOferecimento" => [
                "type" => "char",
                "size" => 32
            ],
            "codigoCursoCEU" => [
                "type" => "integer"
            ],
            "situacaoOferecimento" => [
                "type" => "string",
                "size" => 32,
                "nullable" => true
            ],
            "dataInicioOferecimento" => [
                "type" => "date"
            ],
            "dataFimOferecimento" => [
                "type" => "date"
            ],
            "totalCargaHoraria" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "qntdVagasOfertadas" => [
                "type" => "smallInteger"
            ],
            "cursoPago" => [
                "type" => "char",
                "size" => 1
            ],
            "valorInscricaoEdicao" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "qntdVagasGratuitas" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "valorPrevistoArrecadacao" => [
                "type" => "integer",
                "nullable" => true
            ],
            "valorPrevistoCustos" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "valorPrevistoPRCE" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "cursoParaEmpresas" => [
                "type" => "char",
                "size" => 1
            ],
            "localCurso" => [
                "type" => "string",
                "size" => 256
            ],
            "dataInicioInscricoes" => [
                "type" => "date"
            ],
            "dataFimInscricoes" => [
                "type" => "date"
            ],
            "permiteInscricaoOnline" => [
                "type" => "char",
                "size" => 1,
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
            "key" => ["codigoOferecimento"]
        ],
        
        "foreign" => [
            [
                "keys" => "codigoCursoCEU",
                "references" => "codigoCursoCEU",
                "on" => "cursos_culturaextensao",
                "onDelete" => "cascade"
            ]
        ]
    ];
}