<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Interfaces\Mapper;

class HabilitacaoReplicado implements Mapper
{
    public function mapping(Array $habilitacao)
    {
        $properties = [
            'id_graduacao' => strtoupper(substr(
                hash('sha256',
                    $habilitacao['numero_usp'] . 
                    $habilitacao['sequencia_grad'] .
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'codigo_curso' => $habilitacao['codigo_curso'],
            'codigo_habilitacao' => (int)$habilitacao['codigo_habilitacao'],
            'nome_habilitacao' => $habilitacao['nome_habilitacao'],
            'tipo_habilitacao' => $habilitacao['tipo_habilitacao'], // ver significados
            'periodo_habilitacao' => $habilitacao['periodo_habilitacao'],
            'data_inicio_habilitacao' => $habilitacao['data_inicio_habilitacao'],
            'data_fim_habilitacao' => $habilitacao['data_fim_habilitacao'],
            'tipo_encerramento' => $habilitacao['tipo_encerramento'],
            'data_colacao_grau' => $habilitacao['data_colacao_grau'],
            'data_expedicao_diploma' => $habilitacao['data_expedicao_diploma'],
        ];

        return $properties;
    }
}