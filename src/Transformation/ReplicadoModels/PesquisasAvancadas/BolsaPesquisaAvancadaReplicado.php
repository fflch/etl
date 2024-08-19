<?php

namespace Src\Transformation\ReplicadoModels\PesquisasAvancadas;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;
use Src\Utils\ReplicadoModelsUtils;

class BolsaPesquisaAvancadaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_projeto' => ReplicadoModelsUtils::getPesquisaAvancadaId($record),
            'sequencia_periodo' => $record['sequencia_periodo'],
            'sequencia_fomento' => $record['sequencia_fomento'],
            'codigo_fomento' => $record['codigo_fomento'],
            'nome_fomento' => CommonUtils::cleanInput(
                $record['nome_fomento'],
                ['decode_html']
            ),
            'data_inicio_fomento' => $record['data_inicio_fomento'],
            'data_fim_fomento' => $record['data_fim_fomento'],
            'id_fomento' => CommonUtils::cleanInput(
                $record['id_fomento'],
                ['decode_html']
            ),
        ];

        return $properties;
    }
}
