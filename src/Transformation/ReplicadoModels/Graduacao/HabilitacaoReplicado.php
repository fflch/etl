<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class HabilitacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_graduacao' => ReplicadoModelsUtils::getGraduacaoId($record),
            'codigo_curso' => $record['codigo_curso'],
            'codigo_habilitacao' => (int)$record['codigo_habilitacao'],
            'nome_habilitacao' => $record['nome_habilitacao'],
            'tipo_habilitacao' => Deparas::tiposHabilitacao[$record['tipo_habilitacao']]
                ?? $record['tipo_habilitacao'],
            'periodo_habilitacao' => $record['periodo_habilitacao'],
            'data_inicio_habilitacao' => $record['data_inicio_habilitacao'],
            'data_fim_habilitacao' => $record['data_fim_habilitacao'],
            'tipo_encerramento' => $record['tipo_encerramento'],
            'data_colacao_grau' => $record['data_colacao_grau'],
            'data_expedicao_diploma' => $record['data_expedicao_diploma'],
        ];

        return $properties;
    }
}
