<?php

namespace Src\Transformation\ReplicadoModels\ProgramasUSP;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class BolsaDiversaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_bolsa_diversa' => ReplicadoModelsUtils::getBolsaDiversaId($record),
            'codigo_programa_usp' => $record['codigo_programa_usp'],
            'nome_programa_usp' => $record['nome_programa_usp'],
            'numero_usp' => $record['numero_usp'],
            'situacao_bolsa' => $record['situacao_bolsa'],
            'data_inicio_bolsa' => $record['data_inicio_bolsa'],
            'data_fim_bolsa' => $record['data_fim_bolsa'],
            'justificativa_cancelamento_bolsa' => $record['justificativa_cancelamento_bolsa'],
            'tipo_vinculo_bolsista' => $record['tipo_vinculo_bolsista'],
            'id_graduacao_bolsista' => $this->getIdIfGraduacao($record),
            'nivel_pg_bolsista' => $record['nivel_pg_bolsista'],
            'id_inscricao_projeto' => $this->getIdIfProjeto($record),
            'valor_bolsa_especifico' => $record['valor_bolsa_especifico'],
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

    private function getIdIfProjeto($record)
    {
        if (!empty($record['codigo_projeto_diverso'])) {
            return ReplicadoModelsUtils::getInscricaoProjetoDivId($record);
        }

        return null;
    }
}
