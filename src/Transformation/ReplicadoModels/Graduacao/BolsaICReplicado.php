<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class BolsaICReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_projeto' => ReplicadoModelsUtils::getICId($record),
            'sequencia_fomento' => $record['sequencia_fomento'],
            'nome_fomento' => $record['nome_fomento'],
            'fomento_edital' => $record['fomento_edital'],
            'data_inicio_fomento' => $record['data_inicio_fomento'],
            'data_fim_fomento' => $record['data_fim_fomento'],
        ];

        return $properties;
    }
}
