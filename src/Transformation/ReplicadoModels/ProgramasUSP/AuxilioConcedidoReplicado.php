<?php

namespace Src\Transformation\ReplicadoModels\ProgramasUSP;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class AuxilioConcedidoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_concessao_auxilio' => ReplicadoModelsUtils::getAuxilioId($record),
            'codigo_auxilio' => $record['codigo_auxilio'],
            'nome_auxilio' => $record['nome_auxilio'],
            'numero_usp' => $record['numero_usp'],
            'data_inicio_auxilio' => $record['data_inicio_auxilio'],
            'data_fim_auxilio' => $record['data_fim_auxilio'],
            'situacao_auxilio' => $record['situacao_auxilio'],
            'justificativa_cancelamento_auxilio' => $record['justificativa_cancelamento_auxilio'],
            'tipo_vinculo_beneficiario' => $record['tipo_vinculo_beneficiario'],
            'id_graduacao_beneficiario' => $this->getIdIfGraduacao($record),
            'nivel_pg_beneficiario' => Deparas::niveisPG[$record['nivel_pg_beneficiario']]
                ?? $record['nivel_pg_beneficiario'],
            'cota_mensal_prevista' => $record['cota_mensal_prevista'],
            'valor_auxilio_especifico' => $record['valor_auxilio_especifico'],
            'fonte_pagadora_usp' => Deparas::nToNull($record['fonte_pagadora_usp']),
            'parte_papfe' => Deparas::nToNull($record['parte_papfe']),
            'exige_avaliacao_socioeconomica' => Deparas::nToNull($record['exige_avaliacao_socioeconomica']),
        ];

        return $properties;
    }

    private function getIdIfGraduacao($record)
    {
        if (!empty($record['sequencia_grad'])) {
            return ReplicadoModelsUtils::getGraduacaoId($record);
        }

        return null;
    }
}
