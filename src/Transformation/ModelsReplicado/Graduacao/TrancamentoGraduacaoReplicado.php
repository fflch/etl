<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Interfaces\Mapper;

class TrancamentoGraduacaoReplicado implements Mapper
{
    public function mapping(Array $trancamento)
    {
        $properties = [
            'id_graduacao' => strtoupper(substr(
                hash('sha256',
                    $trancamento['numero_usp'] . 
                    $trancamento['sequencia_grad'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'data_registro_inicio_tranc' => $trancamento['data_registro_inicio_tranc'],
            'periodo_inicio_trancamento' => $trancamento['periodo_inicio_trancamento'],
            'data_registro_fim_tranc' => $trancamento['data_registro_fim_tranc'],
            'periodo_fim_trancamento' => $trancamento['periodo_fim_trancamento'],
            'semestres_trancados' => $trancamento['semestres_trancados'],
            'sequencia_trancamento' => $trancamento['sequencia_trancamento'],
        ];

        return $properties;
    }
}