<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class SIICUSPParticipanteReplicado implements Mapper
{
    public function mapping(Array $participante)
    {
        $properties = [
            'id_trabalho' => $participante['edicao_siicusp'] . "-" . $participante['codigo_trabalho'],
            'tipo_participante' => Deparas::tiposParticipantes[$participante['tipo_participante']] ?? $participante['tipo_participante'],
            'numero_usp' => $participante['numero_usp'],
            'nome_participante' => $participante['nome_participante'],
            'codigo_unidade' => $participante['codigo_unidade'],
            'sigla_unidade' => $participante['sigla_unidade'],
            'codigo_departamento' => $participante['codigo_departamento'],
            'nome_departamento' => $participante['nome_departamento'],
            'participante_apresentador' => $participante['participante_apresentador']
        ];

        return $properties;
    }
}