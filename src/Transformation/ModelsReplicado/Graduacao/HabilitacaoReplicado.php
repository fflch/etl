<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

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