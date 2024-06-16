<?php

namespace Src\Transformation\ReplicadoModels\Servidores;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class DesignacaoServidorReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_vinculo' => ReplicadoModelsUtils::getVinculoId($record),
            'data_inicio_designacao' => $record['data_inicio_designacao'],
            'data_fim_designacao' => $record['data_fim_designacao'],
            'codigo_setor_designacao' => $record['codigo_setor_designacao'],
            'nome_setor_designacao' => $record['nome_setor_designacao'],
            'nome_funcao' => $record['nome_funcao'],
            'tipo_designacao' => Deparas::tiposDesignacaoServidor[$record['tipo_designacao']]
                ?? $record['tipo_designacao'],
        ];

        return $properties;
    }
}
