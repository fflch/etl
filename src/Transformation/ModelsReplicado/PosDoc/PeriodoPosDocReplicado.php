<?php

namespace Src\Transformation\ModelsReplicado\PosDoc;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class PeriodoPosDocReplicado implements Mapper
{
    public function mapping(Array $periodoPosDoc)
    {
        $periodoPosDoc = Utils::emptiesToNull($periodoPosDoc);

        $properties = [
            'id_projeto' => $periodoPosDoc['ano_projeto'] . '-' . $periodoPosDoc['codigo_projeto'],
            'sequencia_periodo' => $periodoPosDoc['sequencia_periodo'],
            'data_inicio_periodo' => $periodoPosDoc['data_inicio_periodo'],
            'data_fim_periodo' => $periodoPosDoc['data_fim_periodo'],
            'situacao_periodo' => Deparas::situacoesPD[$periodoPosDoc['situacao_periodo']] ?? [$periodoPosDoc['situacao_periodo']],
            'fonte_recurso' => $periodoPosDoc['fonte_recurso'],
            'horas_semanais' => $periodoPosDoc['horas_semanais'],
        ];

        return $properties;
    }
}