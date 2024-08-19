<?php

namespace Src\Transformation\ReplicadoModels\CEU;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class InscricaoCCExReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'codigo_oferecimento' => ReplicadoModelsUtils::getOferecimentoCCExId($record),
            'numero_ceu' => $record['numero_ceu'],
            'data_inscricao' => $record['data_inscricao'],
            'situacao_inscricao' => Deparas::situacoesInscricaoCCEx[$record['situacao_inscricao']]
                ?? $record['situacao_inscricao'],
            'origem_inscricao' => Deparas::origensInscricaoCCex[$record['origem_inscricao']]
                ?? $record['origem_inscricao'],
        ];

        return $properties;
    }
}
