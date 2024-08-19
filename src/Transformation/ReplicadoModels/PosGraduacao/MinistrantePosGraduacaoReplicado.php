<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class MinistrantePosGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'numero_usp' => $record['numero_usp'],
            'id_turma' => ReplicadoModelsUtils::getTurmaPosGraduacaoId($record),
        ];

        return $properties;
    }
}
