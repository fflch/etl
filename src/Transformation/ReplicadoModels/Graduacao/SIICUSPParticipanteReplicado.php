<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class SIICUSPParticipanteReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_trabalho' => ReplicadoModelsUtils::getSiicuspTrabalhoId($record),
            'tipo_participante' => Deparas::tiposParticipantes[$record['tipo_participante']] ?? $record['tipo_participante'],
            'numero_usp' => $record['numero_usp'],
            'nome_participante' => $record['nome_participante'],
            'codigo_unidade' => $record['codigo_unidade'],
            'sigla_unidade' => $record['sigla_unidade'],
            'codigo_departamento' => $record['codigo_departamento'],
            'nome_departamento' => $record['nome_departamento'],
            'participante_apresentador' => $record['participante_apresentador']
        ];

        return $properties;
    }
}
