<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class SIICUSPParticipanteReplicado implements Mapper
{
    public function mapping(Array $participante)
    {
        $participante = Utils::emptiesToNull($participante);

        $properties = [
            'id_trabalho' => $participante['edicao_siicusp'] . "-" . $participante['codigo_trabalho'],
            'tipo_participante' => Deparas::tiposParticipantes[$participante['tipo_participante']] ?? $participante['tipo_participante'],
            'numero_usp' => $participante['numero_usp'],
            'nome_participante' => $participante['nome_participante'],
            'codigo_unidade' => $participante['codigo_unidade'],
            'sigla_unidade' => $participante['sigla_unidade'],
            'codigo_departamento' => $participante['codigo_departamento'],
            'nome_departamento' => $participante['nome_departamento'],
            'participante_apresentador' => Deparas::boolSIICUSP[$participante['participante_apresentador']] ?? false
        ];

        return $properties;
    }
}