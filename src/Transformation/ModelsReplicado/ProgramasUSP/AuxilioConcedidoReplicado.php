<?php

namespace Src\Transformation\ModelsReplicado\ProgramasUSP;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;

class AuxilioConcedidoReplicado implements Mapper
{
    public function mapping(Array $auxilio)
    {
        $properties = [
            'id_concessao_auxilio' => strtoupper(substr(
                hash('sha256',
                    $auxilio['codigo_auxilio'] . 
                    $auxilio['sequencia_auxilio'] . 
                    $auxilio['periodo_referencial'] . 
                    $auxilio['numero_usp'] . 
                    $auxilio['data_inicio_auxilio'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'codigo_auxilio' => $auxilio['codigo_auxilio'],
            'nome_auxilio' => $auxilio['nome_auxilio'],
            'numero_usp' => $auxilio['numero_usp'],
            'data_inicio_auxilio' => $auxilio['data_inicio_auxilio'],
            'data_fim_auxilio' => $auxilio['data_fim_auxilio'],
            'situacao_auxilio' => $auxilio['situacao_auxilio'],
            'justificativa_cancelamento_auxilio' => $auxilio['justificativa_cancelamento_auxilio'],
            'tipo_vinculo_beneficiario' => $auxilio['tipo_vinculo_beneficiario'],
            'id_graduacao_beneficiario' => $this->getIdIfGraduacao(
                $auxilio['numero_usp'],
                $auxilio['sequencia_grad']
            ),
            'nivel_pg_beneficiario' => Deparas::niveisPG[$auxilio['nivel_pg_beneficiario']]
                                    ?? $auxilio['nivel_pg_beneficiario'],
            'cota_mensal_prevista' => $auxilio['cota_mensal_prevista'],
            'valor_auxilio_especifico' => $auxilio['valor_auxilio_especifico'],
            'fonte_pagadora_usp' => Deparas::nToNull($auxilio['fonte_pagadora_usp']),
            'parte_papfe' => Deparas::nToNull($auxilio['parte_papfe']),
            'exige_avaliacao_socioeconomica' => Deparas::nToNull($auxilio['exige_avaliacao_socioeconomica']),
        ];

        return $properties;
    }

    private function getIdIfGraduacao($numero_usp, $sequencia_grad)
    {
        if (!empty($sequencia_grad)) {
            return strtoupper(substr(
                hash('sha256',
                    $numero_usp . 
                    $sequencia_grad .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            );
        }
        
        return null;
    }
}