<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class NotasIngressoGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_graduacao' => ReplicadoModelsUtils::getGraduacaoId($record),
            'codigo_prova' => $record['codigo_prova'],
            'descricao_prova' => $record['descricao_prova'],
            'pontos_obtidos' => $record['pontos_obtidos'],
            'pontos_maximo' => $record['pontos_maximo'],
        ];

        return $properties;
    }
}
