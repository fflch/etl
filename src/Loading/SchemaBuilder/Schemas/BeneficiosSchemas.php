<?php

namespace Src\Loading\SchemaBuilder\Schemas;

class BeneficiosSchemas
{
    const beneficios_concedidos = [

        "tableName" => "beneficios_concedidos",

        "columns" => [
            "id_concessao_beneficio" => [
                "type" => "char",
                "size" => 32
            ],
            "tipo_beneficio" => [
                "type" => "string",
                "size" => 12
            ],
            "codigo_beneficio" => [
                "type" => "smallInteger"
            ],
            "nome_beneficio" => [
                "type" => "string",
                "size" => 60
            ],
            "numero_usp" => [
                "type" => "integer",
                "nullable" => true
            ],
            "data_inicio_concessao" => [
                "type" => "datetime"
            ],
            "data_fim_concessao" => [
                "type" => "datetime"
            ],
            "situacao_beneficio" => [
                "type" => "string",
                "size" => 12
            ],
            "justificativa_cancelamento_concessao" => [
                "type" => "string",
                "size" => 256,
                "nullable" => true
            ],
            "tipo_vinculo" => [
                "type" => "string",
                "size" => 40,
                "nullable" => true
            ],
            "id_graduacao" => [
                "type" => "char",
                "size" => 32,
                "nullable" => true
            ],
            "nivel_pos_graduacao" => [
                "type" => "char",
                "size" => 2,
                "nullable" => true
            ],
            "id_projeto_beneficio" => [
                "type" => "string",
                "size" => 12,
                "nullable" => true
            ],
            "cota_mensal_prevista" => [
                "type" => "smallInteger",
                "nullable" => true
            ],
            "valor_beneficio_especifico" => [
                "type" => "decimal",
                "nullable" => true
            ],
        ],

        "primary" => [
            //
        ],
        
        "foreign" => [
            //
        ]
    ];
}