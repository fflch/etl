<?php

namespace Src\Transformation\ModelsReplicado\PesquisasAvancadas;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class PeriodoPesquisaAvancadaReplicado implements Mapper
{
    public function mapping(Array $periodoPesquisa)
    {
        $properties = [
            'id_projeto' => $periodoPesquisa['ano_projeto'] . '-' . $periodoPesquisa['codigo_projeto'],
            'sequencia_periodo' => $periodoPesquisa['sequencia_periodo'],
            'data_inicio_periodo' => $periodoPesquisa['data_inicio_periodo'],
            'data_fim_periodo' => $periodoPesquisa['data_fim_periodo'],
            'situacao_periodo' => Deparas::situacoesPD[$periodoPesquisa['situacao_periodo']] ?? [$periodoPesquisa['situacao_periodo']],
            'fonte_recurso' => $periodoPesquisa['fonte_recurso'],
            'horas_semanais' => $periodoPesquisa['horas_semanais'],
        ];

        return $properties;
    }
}