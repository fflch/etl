<?php

namespace Src\Transformation\ModelsReplicado\PosDoutorado;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class PeriodoPosDoutoradoReplicado implements Mapper
{
    public function mapping(Array $periodoPosDoc)
    {
        $periodoPosDoc = Utils::emptiesToNull($periodoPosDoc);

        $properties = [
            'idProjeto' => $periodoPosDoc['anoProjeto'] . '-' . $periodoPosDoc['codigoProjeto'],
            'sequenciaPeriodo' => $periodoPosDoc['sequenciaPeriodo'],
            'dataInicioPeriodo' => $periodoPosDoc['dataInicioPeriodo'],
            'dataFimPeriodo' => $periodoPosDoc['dataFimPeriodo'],
            'situacaoPeriodo' => Deparas::situacoesPD[$periodoPosDoc['situacaoPeriodo']] ?? [$periodoPosDoc['situacaoPeriodo']],
            'fonteRecurso' => $periodoPosDoc['fonteRecurso'],
            'horasSemanais' => $periodoPosDoc['horasSemanais'],
        ];

        return $properties;
    }
}