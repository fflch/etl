<?php

namespace Src\Transformation\Models;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\Models\Interfaces\Mapper;

class HabilitacaoReplicado implements Mapper
{
    public function mapping(Array $habilitacao)
    {
        $habilitacao = Utils::emptiesToNull($habilitacao);

        $properties = [
            'idGraduacao' => strtoupper(md5($habilitacao['numeroUSP'] . $habilitacao['sequenciaCurso'])),
            'codigoCurso' => $habilitacao['codigoCurso'],
            'codigoHabilitacao' => (int)$habilitacao['codigoHabilitacao'],
            'nomeHabilitacao' => $habilitacao['nomeHabilitacao'],
            'tipoHabilitacao' => $habilitacao['tipoHabilitacao'],
            'periodoHabilitacao' => $habilitacao['periodoHabilitacao'],
            'dataInicioHabilitacao' => $habilitacao['dataInicioHabilitacao'],
            'dataFimHabilitacao' => $habilitacao['dataFimHabilitacao'],
            'tipoEncerramento' => $habilitacao['tipoEncerramento']
        ];

        return $properties;
    }
}