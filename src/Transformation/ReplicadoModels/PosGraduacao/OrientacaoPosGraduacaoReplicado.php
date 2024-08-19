<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class OrientacaoPosGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_posgraduacao' => ReplicadoModelsUtils::getPosGraduacaoId($record),
            'numero_usp_orientador' => $record['numero_usp_orientador'],
            'sequencia_orientacao' => $record['sequencia_orientacao'],
            'tipo_orientacao' => Deparas::tiposOrientacaoPG[$record['tipo_orientacao']]
                ?? $record['tipo_orientacao'],
            'data_inicio_orientacao' => $record['data_inicio_orientacao'],
            'data_fim_orientacao' => $record['data_fim_orientacao'],
            'ultimo_orientador' => $record['ultimo_orientador'],

            /* A orientação específica é a escolhida pelo(a) estudante para cadastro de de doutor(a) 
            não credenciado(a) junto ao Programa no qual o(a) aluno(a) está matriculado(a) */
            'orientacao_especifica' => $record['orientacao_especifica'],
            'data_conversao_para_plena' => $record['data_conversao_para_plena'],
            'data_conversao_para_especifica' => $record['data_conversao_para_especifica'],
        ];

        return $properties;
    }
}
