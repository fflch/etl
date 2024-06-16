<?php

namespace Src\Transformation\ReplicadoModels\CEU;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class MinistranteCCExReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'numero_usp' => $record['numero_usp'],
            'codigo_oferecimento' => ReplicadoModelsUtils::getOferecimentoCCExId($record),
            'turma' => $record['turma'],
            'funcao' => $record['funcao'],
            'forma_exercicio' => Deparas::formasExercicioCEU[$record['forma_exercicio']]
                ?? $record['forma_exercicio'],
            'carga_horaria_horas' => $record['carga_horaria_horas'],
            'data_inicio_turma' => $record['data_inicio_turma'],
            'data_fim_turma' => $record['data_fim_turma'],
        ];

        return $properties;
    }
}
