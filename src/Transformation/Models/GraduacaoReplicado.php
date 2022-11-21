<?php

namespace Src\Transformation\Models;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\Models\Interfaces\Mapper;

class GraduacaoReplicado implements Mapper
{
    public function mapping(Array $graduacao)
    {
        $graduacao = Utils::emptiesToNull($graduacao);

        $properties = [
            'idGraduacao' => strtoupper(md5($graduacao['numeroUSP'] . $graduacao['sequenciaCurso'])),
            'numeroUSP' => (int)$graduacao['numeroUSP'],
            'sequenciaCurso' => (int)$graduacao['sequenciaCurso'],
            'situacao' => Deparas::situacoes[$graduacao['situacao']],
            'dataInicioVinculo' => $graduacao['dataInicioVinculo'],
            'dataFimVinculo' => $graduacao['dataFimVinculo'],
            'codigoCurso' => (int)$graduacao['codigoCurso'],
            'nomeCurso' => $graduacao['nomeCurso'],
            'tipoIngresso' => Deparas::ingressos[$graduacao['tipoIngresso']],
            'categoriaIngresso' => $graduacao['categoriaIngresso'],
            'rankIngresso' => $graduacao['rankIngresso'],
            'tipoEncerramento' => $graduacao['tipoEncerramento'],
        ];

        return $properties;
    }
}