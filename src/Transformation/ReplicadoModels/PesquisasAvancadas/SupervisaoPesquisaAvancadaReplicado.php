<?php

namespace Src\Transformation\ReplicadoModels\PesquisasAvancadas;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class SupervisaoPesquisaAvancadaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_projeto' => ReplicadoModelsUtils::getPesquisaAvancadaId($record),
            'sequencia_supervisao' => $record['sequencia_supervisao'],
            'numero_usp_supervisor' => $record['numero_usp_supervisor'],
            'tipo_supervisao' => $record['tipo_supervisao'],
            'data_inicio_supervisao' => $record['data_inicio_supervisao'],
            'data_fim_supervisao' => $record['data_fim_supervisao'],
            'ultimo_supervisor_resp' => $record['ultimo_supervisor_resp'],
        ];

        return $properties;
    }
}
