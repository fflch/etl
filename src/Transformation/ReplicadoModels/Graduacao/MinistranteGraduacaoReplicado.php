<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class MinistranteGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'numero_usp' => $record['numero_usp'],
            'id_turma' => ReplicadoModelsUtils::getTurmaGraduacaoId($record),
            'periodicidade_ministrante' => Deparas::periodicidadeProf[$record['periodicidade_ministrante']]
                ?? $record['periodicidade_ministrante']
        ];

        return $properties;
    }
}
