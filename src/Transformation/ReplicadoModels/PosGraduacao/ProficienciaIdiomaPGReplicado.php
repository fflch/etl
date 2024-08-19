<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class ProficienciaIdiomaPGReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_posgraduacao' => ReplicadoModelsUtils::getPosGraduacaoId($record),
            'idioma' => $record['idioma'],
            'data_exame' => $record['data_exame'],
        ];

        return $properties;
    }
}
