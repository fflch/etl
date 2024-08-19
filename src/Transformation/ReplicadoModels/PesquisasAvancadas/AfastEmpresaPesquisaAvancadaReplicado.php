<?php

namespace Src\Transformation\ReplicadoModels\PesquisasAvancadas;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class AfastEmpresaPesquisaAvancadaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_projeto' => ReplicadoModelsUtils::getPesquisaAvancadaId($record),
            'sequencia_periodo' => $record['sequencia_periodo'],
            'seq_vinculo_empresa' => $record['seq_vinculo_empresa'],
            'nome_empresa' => CommonUtils::cleanInput(
                $record['nome_empresa'],
                ['decode_html']
            ),
            'data_inicio_afastamento' => $record['data_inicio_afastamento'],
            'data_fim_afastamento' => $record['data_fim_afastamento'],
            'tipo_vinculo' => Deparas::tiposVinculoPD[$record['tipo_vinculo']] ?? $record['tipo_vinculo'],
        ];

        return $properties;
    }
}
