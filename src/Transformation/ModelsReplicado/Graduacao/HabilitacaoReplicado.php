<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class HabilitacaoReplicado implements Mapper
{
    public function mapping(Array $habilitacao)
    {
        $habilitacao = Utils::emptiesToNull($habilitacao);

        $properties = [
            'id_graduacao' => strtoupper(md5($habilitacao['numero_usp'] . $habilitacao['sequencia_curso'])),
            'codigo_curso' => $habilitacao['codigo_curso'],
            'codigo_habilitacao' => (int)$habilitacao['codigo_habilitacao'],
            'nome_habilitacao' => $habilitacao['nome_habilitacao'],
            'tipo_habilitacao' => $habilitacao['tipo_habilitacao'],
            'periodo_habilitacao' => $habilitacao['periodo_habilitacao'],
            'data_inicio_habilitacao' => $habilitacao['data_inicio_habilitacao'],
            'data_fim_habilitacao' => $habilitacao['data_fim_habilitacao'],
            'tipo_encerramento' => $habilitacao['tipo_encerramento']
        ];

        return $properties;
    }
}