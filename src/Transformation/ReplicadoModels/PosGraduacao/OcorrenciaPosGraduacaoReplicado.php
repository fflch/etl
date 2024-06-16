<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class OcorrenciaPosGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_posgraduacao' => ReplicadoModelsUtils::getPosGraduacaoId($record),
            'data_ocorrencia' => $record['data_ocorrencia'],
            'tipo_ocorrencia' => $record['tipo_ocorrencia'],
            'motivo_ocorrencia' => $record['motivo_ocorrencia'],
            'prazo_afastamento' => $record['prazo_afastamento'],
            'codigo_area_destino' => $record['codigo_area_destino'],
            'nome_area_destino' => $record['nome_area_destino'],
            'nivel_programa_destino' => Deparas::niveisPG[$record['nivel_programa_destino']]
                ?? $record['nivel_programa_destino'],
            'prorrogacao_def_solicitada_dias' => $record['prorrogacao_def_solicitada_dias'],
            'prorrogacao_def_obtida_dias' => $record['prorrogacao_def_obtida_dias'],
        ];

        return $properties;
    }
}
