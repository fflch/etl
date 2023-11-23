<?php

namespace Src\Transformation\Models;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Models\Interfaces\Mapper;

class BolsaICReplicado implements Mapper
{
    public function mapping(Array $bolsaIC)
    {
        $bolsaIC = Utils::emptiesToNull($bolsaIC);

        $properties = [
            'idProjeto' => ($bolsaIC['anoProjeto'] . '-' . $bolsaIC['codigoProjeto']),
            'sequenciaBolsa' => $bolsaIC['order'],
            'nomePrograma' => $bolsaIC['nomePrograma'],
            'bolsaEdital' => $bolsaIC['bolsaEdital'],
            'dataInicioBolsa' => $bolsaIC['dataInicioBolsa'],
            'dataFimBolsa' => $bolsaIC['dataFimBolsa'],
        ];

        return $properties;
    }
}