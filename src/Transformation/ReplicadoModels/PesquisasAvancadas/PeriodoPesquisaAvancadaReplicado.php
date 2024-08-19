<?php

namespace Src\Transformation\ReplicadoModels\PesquisasAvancadas;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class PeriodoPesquisaAvancadaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_projeto' => ReplicadoModelsUtils::getPesquisaAvancadaId($record),
            'sequencia_periodo' => $record['sequencia_periodo'],
            'data_inicio_periodo' => $record['data_inicio_periodo'],
            'data_fim_periodo' => $record['data_fim_periodo'],
            'situacao_periodo' => Deparas::situacoesPD[$record['situacao_periodo']]
                ?? [$record['situacao_periodo']],
            'fonte_recurso' => $record['fonte_recurso'],
            'horas_semanais' => $record['horas_semanais'],
        ];

        return $properties;
    }
}
