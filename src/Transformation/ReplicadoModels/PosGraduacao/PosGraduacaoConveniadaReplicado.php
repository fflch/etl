<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class PosGraduacaoConveniadaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_posgraduacao' => ReplicadoModelsUtils::getPosGraduacaoId($record),
            'codigo_convenio' => $record['codigo_convenio'],
            'sigla_convenio' => $record['sigla_convenio'],
            'nome_convenio' => $record['nome_convenio'],
        ];

        return $properties;
    }
}
