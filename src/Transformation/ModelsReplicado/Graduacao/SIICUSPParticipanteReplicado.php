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
            'idTrabalho' => $participante['edicaoSIICUSP'] . "-" . $participante['codigoTrabalho'],
            'numeroUSP' => $participante['numeroUSP'],
            'nome' => $participante['nome'],
            'tipoParticipante' => Deparas::tiposParticipantes[$participante['tipoParticipante']] ?? $participante['tipoParticipante'],
            'codigoUnidade' => $participante['codigoUnidade'],
            'siglaUnidade' => $participante['siglaUnidade'],
            'codigoDepartamento' => $participante['codigoDepartamento'],
            'nomeDepartamento' => $participante['nomeDepartamento'],
            'apresentou' => $participante['apresentou']
        ];

        return $properties;
    }
}