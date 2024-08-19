<?php

namespace Src\Transformation\ReplicadoModels\CEU;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class CoordenadorCCExReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'numero_usp' => $record['numero_usp'],
            'codigo_oferecimento' => ReplicadoModelsUtils::getOferecimentoCCExId($record),
            'funcao' => $record['funcao'],
            'forma_exercicio' => Deparas::formasExercicioCEU[$record['forma_exercicio']]
                ?? $record['forma_exercicio'],
        ];

        return $properties;
    }
}
