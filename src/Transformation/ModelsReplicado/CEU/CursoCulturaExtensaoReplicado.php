<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class CursoCulturaExtensaoReplicado implements Mapper
{
    public function mapping(Array $cursoCEU)
    {
        $cursoCEU = Utils::emptiesToNull($cursoCEU);

        $properties = [
            'codigoCursoCEU' => $cursoCEU['codigoCursoCEU'],
            'siglaUnidade' => $cursoCEU['siglaUnidade'],
            'codigoDepartamento' => $cursoCEU['codigoDepartamento'],
            'nomeDepartamento' => $cursoCEU['nomeDepartamento'],
            'modalidadeCurso' => $cursoCEU['modalidadeCurso'],
            'nomeCurso' => $cursoCEU['nomeCurso'],
            'tipo' => $cursoCEU['tipo'],
            'codigoColegiado' => $cursoCEU['codigoColegiado'],
            'siglaColegiado' => $cursoCEU['siglaColegiado'],
            'areaConhecimento' => $cursoCEU['areaConhecimento'],
            'areaTematica' => $cursoCEU['areaTematica'],
            'linhaExtensao' => $cursoCEU['linhaExtensao'],
        ];

        return $properties;
    }
}