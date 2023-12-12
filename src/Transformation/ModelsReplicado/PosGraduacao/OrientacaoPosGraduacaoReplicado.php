<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class OrientacaoPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $orientacaoPG)
    {
        $properties = [
            'id_posgraduacao' => strtoupper(substr(
                hash('sha256',
                    $orientacaoPG['numero_usp_aluno'] . 
                    $orientacaoPG['seq_programa'] .
                    $orientacaoPG['codigo_area'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'numero_usp_orientador' => $orientacaoPG['numero_usp_orientador'],
            'sequencia_orientacao' => $orientacaoPG['sequencia_orientacao'],
            'tipo_orientacao' => Deparas::tiposOrientacaoPG[$orientacaoPG['tipo_orientacao']]
                                 ?? $orientacaoPG['tipo_orientacao'],
            'data_inicio_orientacao' => $orientacaoPG['data_inicio_orientacao'],
            'data_fim_orientacao' => $orientacaoPG['data_fim_orientacao'],
            'ultimo_orientador' => $orientacaoPG['ultimo_orientador'],

            /* A orientação específica é a escolhida pelo(a) estudante para cadastro de de doutor(a) 
            não credenciado(a) junto ao Programa no qual o(a) aluno(a) está matriculado(a) */
            'orientacao_especifica' => $orientacaoPG['orientacao_especifica'],
            'data_conversao_para_plena' => $orientacaoPG['data_conversao_para_plena'],
            'data_conversao_para_especifica' => $orientacaoPG['data_conversao_para_especifica'],
        ];

        return $properties;
    }
}