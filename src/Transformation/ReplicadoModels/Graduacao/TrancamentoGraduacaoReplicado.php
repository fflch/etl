<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class TrancamentoGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_graduacao' => ReplicadoModelsUtils::getGraduacaoId($record),
            'data_registro_inicio_tranc' => $record['data_registro_inicio_tranc'],
            'periodo_inicio_trancamento' => $record['periodo_inicio_trancamento'],
            'data_registro_fim_tranc' => $record['data_registro_fim_tranc'],
            'periodo_fim_trancamento' => $record['periodo_fim_trancamento'],
            'semestres_trancados' => $record['semestres_trancados'],
            'sequencia_trancamento' => $record['sequencia_trancamento'],
        ];

        return $properties;
    }
}
